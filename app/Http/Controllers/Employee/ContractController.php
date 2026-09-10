<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\HRD\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    /**
     * Menampilkan daftar contract milik employee yang sedang login.
     */
    public function index()
    {
         $user = Auth::user();

        if (!$user->hasPermissionTo('read-my-contracts')) {
            abort(403, 'Unallowed.');
        }
        $contracts = Contract::with('project')
            ->where('user_id', auth()->id())
            ->whereIn('status', [
                'sent',
                'viewed',
                'signed',
                'expired',
            ])
            ->latest()
            ->get();

        return view('admin.employee.contracts.index', compact('contracts'));
    }


    /**
     * Menampilkan detail contract milik employee.
     */
    public function show(Contract $contract)
    {
         $user = Auth::user();

        if (!$user->hasPermissionTo('read-my-contracts')) {
            abort(403);
        }
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        | Employee hanya boleh melihat contract yang memang ditujukan
        | kepada akun yang sedang login.
        */
        if ($contract->user_id !== auth()->id()) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Update Status
        |--------------------------------------------------------------------------
        | Jika sebelumnya masih "sent", berarti employee baru pertama kali
        | membuka contract tersebut.
        */
        if ($contract->status === 'sent') {

            $contract->update([
                'status' => 'viewed',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Relationship
        |--------------------------------------------------------------------------
        */
        $contract->load([
            'project',
            'creator',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view(
            'admin.employee.contracts.show',
            compact('contract')
        );
    }
  public function sign(Request $request, Contract $contract)
{
    try {

        // Pastikan contract milik employee yang sedang login
        if ($contract->user_id !== auth()->id()) {
            abort(403);
        }

        // Contract hanya bisa ditandatangani jika status sent/viewed
        if (!in_array($contract->status, ['sent', 'viewed'])) {
            return redirect()
                ->back()
                ->with('ERR', 'Contract tidak dapat ditandatangani.');
        }

        // Validasi
        $request->validate([
            'signature' => 'required|string',
            'agreement' => 'required|accepted',
        ]);

        $signature = $request->signature;

        // Pastikan format signature adalah PNG base64
        if (!preg_match('/^data:image\/png;base64,/', $signature)) {
            return redirect()
                ->back()
                ->with('ERR', 'Format tanda tangan tidak valid.');
        }

        // Hapus prefix data:image/png;base64,
        $signature = str_replace(
            'data:image/png;base64,',
            '',
            $signature
        );

        // Decode base64
        $imageData = base64_decode($signature, true);

        if ($imageData === false) {
            return redirect()
                ->back()
                ->with('ERR', 'Data tanda tangan tidak valid.');
        }

        // Nama file
        $fileName = 'signature_' . $contract->id . '_' . time() . '.png';

        // Path penyimpanan
        $path = 'contracts/signatures/' . $fileName;

        // Simpan file
        Storage::disk('public')->put($path, $imageData);

        // Simpan ke database
        $contract->update([
            'signature' => $path,
            'status' => 'signed',
            'signed_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('OK', 'Contract Berhasil Ditandatangani');

    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->with(
                'ERR',
                'Gagal Menandatangani Contract: ' . $e->getMessage()
            );
    }
}
}
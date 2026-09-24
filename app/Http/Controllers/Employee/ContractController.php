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
    'signed-hrd',
    'signed-head',
    'expired',
])
            ->latest()
            ->get();

        return view('admin.employee.contracts.index', compact('contracts'));
    }


    /**
     * Menampilkan detail contract milik employee.
     */
   
public function sign(Request $request, Contract $contract)
{
    try {

        // =====================================================
        // CEK OWNERSHIP CONTRACT
        // =====================================================

        if ($contract->user_id !== auth()->id()) {
            abort(403);
        }


        // =====================================================
        // CEK STATUS CONTRACT
        // =====================================================

        if (!in_array($contract->status, ['sent', 'viewed'])) {
            return redirect()
                ->back()
                ->with('ERR', 'Contract tidak dapat ditandatangani.');
        }


        // =====================================================
        // VALIDASI
        // =====================================================

        $request->validate([
            'signature' => 'required|string',
            'agreement' => 'required|accepted',
        ]);


        // =====================================================
        // SIGNATURE DATA
        // =====================================================

        $signature = $request->signature;


        // Pastikan signature berupa PNG Base64
        if (!str_starts_with($signature, 'data:image/png;base64,')) {
            return redirect()
                ->back()
                ->with('ERR', 'Format tanda tangan tidak valid.');
        }


        // =====================================================
        // DECODE BASE64
        // =====================================================

        $signature = substr(
            $signature,
            strlen('data:image/png;base64,')
        );

        $imageData = base64_decode($signature, true);

        if ($imageData === false) {
            return redirect()
                ->back()
                ->with('ERR', 'Data tanda tangan tidak valid.');
        }


        // =====================================================
        // SIMPAN FILE SIGNATURE
        // =====================================================

        $fileName = 'employee_signature_'
            . $contract->id
            . '_'
            . time()
            . '.png';

        $path = 'contracts/signatures/' . $fileName;

        Storage::disk('public')->put(
            $path,
            $imageData
        );


        // =====================================================
        // UPDATE CONTRACT
        // =====================================================

        $contract->update([
            'employee_signature' => $path,
            'employee_signed_at' => now(),
            'status' => 'signed',
        ]);


        // =====================================================
        // SUCCESS
        // =====================================================

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
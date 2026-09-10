<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    // Ambil semua data
    $allData = Sop::all();
    
    // Filter hanya menampilkan 1 data per nama (yang rev tertinggi/terbaru)
    $data = $allData->groupBy('nama')->map(function ($group) {
        return $group->sortByDesc('rev')->first();
    })->values();

    $view = [
        'data' => $data,
        'allData' => $allData, // Kirim semua data untuk history di dropdown
    ];

    return view('admin.sop.index', $view);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = Auth::user();

    // if (!$user->hasPermissionTo('create-pelanggan')) {
    //     abort(403, 'Unallowed.');
    // }

    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'kode'     => 'required|string|max:255',
        'tanggal'  => 'required|date',
        'vendor'   => 'required|string|max:255',
        'file_pdf' => 'required|file|mimes:pdf|max:10240',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }
    // dd($request->all());

    try {

        // Upload PDF
        $filePath = $request->file('file_pdf')->store(
            'alat-kesehatan',
            'public'
        );

        Sop::create([
            'nama'              => $request->name,
            'kode'              => $request->kode,
            'tanggal_kadaluarsa' => $request->tanggal,
            'vendor'            => $request->vendor,
            'file_pdf'          => $filePath,
        ]);

        return redirect()
            ->back()
            ->with('OK', 'SOP Berhasil Dibuat');

    } catch (Exception $e) {

        return redirect()
            ->back()
            ->with('ERR', 'Gagal Membuat SOP: ' . $e->getMessage());
    }
}



    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // if (!$user->hasPermissionTo('edit-pelanggan')) {
        //     abort(403, 'Unallowed.');
        // }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
        'tanggal'  => 'required|date',
        'vendor'   => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = Sop::findOrFail($id);

            $data->update([
              'nama' => $request->name,
            'kode' => $request->kode,
            'tanggal_kadaluarsa' => $request->tanggal,
            'vendor' => $request->vendor,
            ]);

            return redirect()->back()
                ->with('OK', 'SOP Berhasil Diperbarui');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('ERR', 'Gagal Memperbarui SOP: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Sop::find($id);
        $user = Auth::user();

        // if (!$user->hasPermissionTo('delete-pelanggan')) {
        //     abort(403, 'Unallowed.');
        // }

        if ($data) {
            $data->delete();
            return redirect()->route('sop.index')->with('OK', 'Data successfully deleted.');
        } else {
            return redirect()->route('sop.index')->with('ERR', 'Data not found.');
        }
    }

    public function getCustomerId()
    {
        $customerId = Customer::all();

        if ($customerId->isEmpty()) {
            return response()->json(['message' => 'No Unit ID found'], 404);
        }

        return response()->json($customerId);
    }

public function viewPdf($id)
{
    $data = Sop::findOrFail($id);

    if (!$data->file_pdf) {
        abort(404, 'File PDF tidak ditemukan.');
    }

    $path = Storage::disk('public')->path($data->file_pdf);

    if (!file_exists($path)) {
        abort(404, 'File PDF tidak ditemukan.');
    }

    return response()->file($path);
}

}

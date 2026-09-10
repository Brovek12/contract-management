<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProjectController extends Controller
{
    public function index()
    {
         
        $user = Auth::user();
         if (!$user->hasPermissionTo('read-projects')) {
    abort(403);
}

        $data = Project::latest()->get();

        $view = [
            'data' => $data,
        ];

        return view('admin.hrd.project.index', $view);
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        // if (!$user->hasPermissionTo('create-project')) {
        //     abort(403, 'Unallowed.');
        // }

        $validator = Validator::make($request->all(), [
            'code'      => 'required|string|max:255|unique:projects,code',
            'name'      => 'required|string|max:255',
            'location'  => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            Project::create([
                'code'      => $request->code,
                'name'      => $request->name,
                'location'  => $request->location,
                'is_active' => $request->is_active,
            ]);

            return redirect()
                ->back()
                ->with('OK', 'Project Berhasil Dibuat');

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->with('ERR', 'Gagal Membuat Project: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // if (!$user->hasPermissionTo('update-project')) {
        //     abort(403, 'Unallowed.');
        // }

        $validator = Validator::make($request->all(), [
            'code'      => 'required|string|max:255|unique:projects,code,' . $id,
            'name'      => 'required|string|max:255',
            'location'  => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $project = Project::findOrFail($id);

            $project->update([
                'code'      => $request->code,
                'name'      => $request->name,
                'location'  => $request->location,
                'is_active' => $request->is_active,
            ]);

            return redirect()
                ->back()
                ->with('OK', 'Project Berhasil Diubah');

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->with('ERR', 'Gagal Mengubah Project: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $user = Auth::user();

        // if (!$user->hasPermissionTo('delete-project')) {
        //     abort(403, 'Unallowed.');
        // }

        try {

            $project = Project::findOrFail($id);

            $project->delete();

            return redirect()
                ->back()
                ->with('OK', 'Project Berhasil Dihapus');

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->with('ERR', 'Gagal Menghapus Project: ' . $e->getMessage());
        }
    }
}
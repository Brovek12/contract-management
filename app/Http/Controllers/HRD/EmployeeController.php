<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = User::latest()->get();

        $view = [
            'data' => $data,
        ];

        return view('admin.hrd.employee.index', $view);
    }


   
}
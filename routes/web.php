<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\Project\ProjectController;
  use App\Http\Controllers\HRD\EmployeeController;
  use App\Http\Controllers\HRD\ContractController;

  use App\Http\Controllers\Employee\ContractController as EmployeeContractController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get(
    'my-contracts',
    [EmployeeContractController::class, 'index']
)->name('employee.contracts.index');

Route::get(
    'my-contracts/{contract}',
    [EmployeeContractController::class, 'show']
)->name('employee.contracts.show');

Route::post(
    'my-contracts/{contract}/sign',
    [EmployeeContractController::class, 'sign']
)->name('employee.contracts.sign');
  

Route::resource('projects', ProjectController::class);
Route::resource('employees', EmployeeController::class);

Route::post(
    'contracts/{contract}/send',
    [ContractController::class, 'send']
)->name('contracts.send');


Route::post('/contracts/{contract}/approve-hrd',
    [ContractController::class, 'approveHRD']
)->name('contracts.approve.hrd');

Route::post('/contracts/{contract}/approve-head',
    [ContractController::class, 'approveHead']
)->name('contracts.approve.head');
Route::resource('contracts', ContractController::class);

    Route::resource('user', UserController::class);
    Route::resource('sop', SopController::class);
    Route::resource('role', RoleController::class);
    Route::post('/role/updatePermissions', [RoleController::class, 'updatePermissions'])->name('role.updatePermissions');
    Route::post('/role/deletePermissions', [RoleController::class, 'deletePermissions'])->name('role.deletePermissions');
    Route::post('/role/updateSinglePermissions', [RoleController::class, 'updateSinglePermissions'])->name('role.updateSinglePermissions');
    Route::get(
    '/alat-kesehatan/{id}/pdf',
    [SopController::class, 'viewPdf']
)->name('alat-kesehatan.pdf');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

<?php

use Illuminate\Support\Facades\Route;

// ==== Controllers ====
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\HRD\EmployeeController;
use App\Http\Controllers\HRD\ContractController;
use App\Http\Controllers\Employee\ContractController as EmployeeContractController;


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ---- Dashboard ----
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    /*
    |----------------------------------------------------------------------
    | Employee — My Contracts
    |----------------------------------------------------------------------
    */
    Route::prefix('my-contracts')->name('employee.contracts.')->group(function () {
        Route::get('/',              [EmployeeContractController::class, 'index'])->name('index');
        Route::get('/{contract}',    [EmployeeContractController::class, 'show'])->name('show');
        Route::post('/{contract}/sign', [EmployeeContractController::class, 'sign'])->name('sign');
    });


    /*
    |----------------------------------------------------------------------
    | Master Data
    |----------------------------------------------------------------------
    */
    Route::resource('projects',  ProjectController::class);
    Route::resource('employees', EmployeeController::class);


    /*
    |----------------------------------------------------------------------
    | HRD — Contracts
    |----------------------------------------------------------------------
    | NOTE: Route custom (send, approve, bulk-*) HARUS dideklarasikan
    |       SEBELUM Route::resource agar tidak dianggap sebagai {contract}.
    */
    Route::prefix('contracts')->name('contracts.')->group(function () {
            Route::get('export', [ContractController::class, 'export'])->name('export');

        // -- Custom actions --
        Route::post('{contract}/send',         [ContractController::class, 'send'])->name('send');
        Route::post('{contract}/approve-hrd',  [ContractController::class, 'approveHRD'])->name('approve.hrd');
        Route::post('{contract}/approve-head', [ContractController::class, 'approveHead'])->name('approve.head');

        // -- Bulk actions --
        Route::delete('bulk-delete',      [ContractController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('bulk-send',          [ContractController::class, 'bulkSend'])->name('bulk-send');
        Route::post('bulk-approve-hrd',   [ContractController::class, 'bulkApproveHRD'])->name('bulk-approve-hrd');
        Route::post('bulk-approve-head',  [ContractController::class, 'bulkApproveHead'])->name('bulk-approve-head');
    });

    // -- Resource (index, create, store, show, edit, update, destroy) --
    Route::resource('contracts', ContractController::class);


    /*
    |----------------------------------------------------------------------
    | User, SOP, Role
    |----------------------------------------------------------------------
    */
    Route::resource('user', UserController::class);
    Route::resource('sop',  SopController::class);
    Route::resource('role', RoleController::class);

    Route::prefix('role')->name('role.')->group(function () {
        Route::post('updatePermissions',       [RoleController::class, 'updatePermissions'])->name('updatePermissions');
        Route::post('deletePermissions',       [RoleController::class, 'deletePermissions'])->name('deletePermissions');
        Route::post('updateSinglePermissions', [RoleController::class, 'updateSinglePermissions'])->name('updateSinglePermissions');
    });

    Route::get('/alat-kesehatan/{id}/pdf', [SopController::class, 'viewPdf'])->name('alat-kesehatan.pdf');


    /*
    |----------------------------------------------------------------------
    | Logout
    |----------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
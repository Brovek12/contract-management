<?php

namespace App\Http\Controllers;

use App\Models\HRD\Contract;
use App\Models\Project\Project;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    // Employee langsung redirect ke my-contracts
    if (auth()->user()->hasRole('employee')) {
        return redirect()->route('employee.contracts.index');
    }

    // ===== STATISTIK KARTU =====
    $stats = [
        'total'      => Contract::count(),
        'draft'      => Contract::where('status', 'draft')->count(),
        'pending'    => Contract::whereIn('status', ['sent', 'viewed', 'signed', 'signed-hrd'])->count(),
        'complete'   => Contract::where('status', 'signed-head')->count(),
        'expired'    => Contract::where('end_date', '<', now())
                            ->where('status', '!=', 'signed-head')
                            ->count(),
    ];

    // ===== KONTRAK PERLU TINDAKAN (5 terbaru) =====
    $needAction = Contract::with(['user', 'project'])
        ->whereIn('status', ['signed', 'signed-hrd'])    // butuh approve HRD/Head
        ->latest()
        ->take(5)
        ->get();

    // ===== AKAN EXPIRED 30 HARI =====
    $expiringSoon = Contract::with(['user', 'project'])
        ->where('status', 'signed-head')
        ->whereBetween('end_date', [now(), now()->addDays(30)])
        ->orderBy('end_date')
        ->take(5)
        ->get();

    // ===== KONTRAK PER BULAN (12 bulan) =====
    $monthlyContracts = Contract::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
        ->where('created_at', '>=', now()->subMonths(12))
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // ===== DISTRIBUSI STATUS =====
    $statusDistribution = Contract::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();

    // ===== TOP 5 PROJECT =====
    $topProjects = Contract::selectRaw('project_id, COUNT(*) as total')
        ->with('project:id,name')
        ->groupBy('project_id')
        ->orderByDesc('total')
        ->take(5)
        ->get();

    return view('admin.dashboard.index', compact(
        'stats',
        'needAction',
        'expiringSoon',
        'monthlyContracts',
        'statusDistribution',
        'topProjects'
    ));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

{{-- ============================================================= --}}
{{-- PASAL 4 — DOMISILI                                           --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

<div class="pasal-title">PASAL 4</div>
<div class="pasal-subtitle">DOMISILI</div>

@php
    // Mapping type → kota domisili
    $domisiliMap = [
        // =====================
        // Balikpapan
        // =====================
        'eni-civil-all-in'        => 'Balikpapan',
        'eni-civil-reguler'       => 'Balikpapan/Handil',
        'eni-muara-bakau-lembur'  => 'Balikpapan',
        'eni-muara-bakau-all-in'  => 'Balikpapan',
        'elis-phkt-6-1'           => 'Balikpapan',
        'phss-humas'              => 'Santan',
        'phss-reguler'            => 'Balikpapan',
        'phss-security'           => 'Balikpapan',
        'sandmon-teknisi-1'       => 'Balikpapan',
        'sandmon-teknisi-2'       => 'Balikpapan',
        'sched-5-2'               => 'Balikpapan',

        // =====================
        // Handil
        // =====================
        'eni-smallcapital-all-in'    => 'Handil',
        'eni-smallcapital-reguler'   => 'Handil',
        'elis-phkt-5-2'              => 'Balikpapan/Handil',

        // =====================
        // Tarakan
        // =====================
        'warlok-all-in'           => 'Tarakan',
        'warlok-lembur'           => 'Tarakan',
        'warlok-security'         => 'Tarakan',

        // =====================
        // Lawe-Lawe (Penajam Paser Utara)
        // =====================
        'lawe-lawe-reguler'       => 'Lawe-Lawe (Penajam Paser Utara)',
        'lawe-lawe-all-in'        => 'Lawe-Lawe (Penajam Paser Utara)',

        // =====================
        // PHSS Major — Sanga Sanga
        // =====================
        'phss-major-ai-1'         => 'Balikpapan',
        'phss-major-ai-2'         => 'Balikpapan',
        'phss-major-ai-3'         => 'Balikpapan',
        'phss-driver'             => 'Balikpapan',

        // =====================
        // PEP Lokal Bunyu
        // =====================
        'pep-lokal-buny'          => 'Balikpapan/Handil',

        // =====================
        // IPFMS Dobu
        // =====================
        'ipfms-dobu'              => 'Balikpapan',
    ];

    $domisili = $domisiliMap[$type] ?? ($c->domicile ?? 'Balikpapan');
@endphp

<p>
    Pekerja diwajibkan berdomisili atau bertempat tinggal di daerah
    <strong>{{ $domisili }}</strong> dan sekitarnya atas tanggungan sendiri
    dan tidak menuntut biaya transportasi tambahan.
</p>
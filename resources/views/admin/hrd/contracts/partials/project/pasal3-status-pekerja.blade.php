{{-- ============================================================= --}}
{{-- PASAL 3 — STATUS PEKERJA                                     --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

<div class="pasal-title">PASAL 3</div>
<div class="pasal-subtitle">STATUS PEKERJA</div>

@php
    // Mapping type → varian kalimat
    $statusTexts = [
        // =====================
        // Varian A — Tanpa Klausul Onshore/Offshore (ENI Civil)
        // =====================
        'eni-civil-all-in' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT. Bukaka Teknik Utama tbk. cabang Balikpapan.',

        'eni-civil-reguler' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT. Bukaka Teknik Utama tbk. cabang Balikpapan.',

        // =====================
        // Varian B — Site ENI Small Capital
        // =====================
        'eni-smallcapital-all-in' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan di lokasi ENI SMALL CAPITAL.',

        'eni-smallcapital-reguler' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan di lokasi ENI SMALL CAPITAL.',

        // =====================
        // Varian — ENI Muara Bakau
        // =====================
        'eni-muara-bakau-lembur' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan diseluruh lokasi Onshore / Offshore yang ditentukan oleh User / Perusahaan.',

        'eni-muara-bakau-all-in' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan diseluruh lokasi Onshore / Offshore yang ditentukan oleh User / Perusahaan.',

        // =====================
        // Varian — Warlok Medco Tarakan
        // =====================
        'warlok-all-in' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan dilokasi Medco EP Tarakan.',

        'warlok-lembur' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan dilokasi Medco EP Tarakan.',

        'warlok-security' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan dilokasi Medco EP Tarakan.',

        // =====================
        // Varian — ELIS PHKT
        // =====================
        'elis-phkt-5-2' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Kalimantan Timur.',

        'elis-phkt-6-1' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Kalimantan Timur.',

        // =====================
        // Varian — PHSS Major
        // =====================
        'phss-major-ai-1' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Sanga Sanga.',

        'phss-major-ai-2' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Sanga Sanga.',

        'phss-major-ai-3' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan dilokasi Pertamina Hulu Sanga Sanga.',

        'phss-driver' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai Driver di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Sanga Sanga.',

        'phss-humas' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Sanga-Sanga.',

        'phss-reguler' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk Cabang Balikpapan dan bersedia ditempatkan di lokasi Pertamina Hulu Sanga Sanga.',

        'phss-security' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan dilokasi Workshop PT Bukaka Project Pertamina Hulu Sanga Sanga.',

        // =====================
        // Varian — Sand Monitoring
        // =====================
        'sandmon-teknisi-1' => 'Perusahaan dengan ini menugaskan Karyawan untuk menjalankan tugasnya sebagai TECHNICIAN 1 di PT. Bukaka Teknik Utama Balikpapan dan bersedia ditempatkan di lokasi kerja site ……. dan atau seluruh area Pertamina Hulu Mahakam',

        'sandmon-teknisi-2' => 'Perusahaan dengan ini menugaskan Karyawan untuk menjalankan tugasnya sebagai TECHNICIAN 2 di PT. Bukaka Teknik Utama Balikpapan dan bersedia ditempatkan di lokasi kerja site ……. dan atau seluruh area Pertamina Hulu Mahakam',

        // =====================
        // Varian — Lain-lain
        // =====================
        'pep-lokal-buny' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan diseluruh lokasi Onshore / Offshore yang ditentukan oleh User / Perusahaan.',

        'sched-5-2' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' dengan Golongan ' . ($c->grade ?? '................') . ' di PT. Bukaka Teknik Utama Balikpapan dan bersedia ditempatkan di lokasi ……………..',

        'lawe-lawe-reguler' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan di lokasi Onshore / Offshore – User / Perusahaan.',

        'lawe-lawe-all-in' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan di lokasi Onshore / Offshore – User / Perusahaan.',

        'ipfms-dobu' => 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan dan bersedia ditempatkan diseluruh lokasi Onshore / Offshore yang ditentukan oleh User / Perusahaan.',
    ];

    $text = $statusTexts[$type] ?? 'Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai ' . ($c->position ?? '................') . ' di PT Bukaka Teknik Utama Tbk cabang Balikpapan.';
@endphp

<p>{{ $text }}</p>
{{-- ============================================================= --}}
{{-- PASAL 5 — PENDAPATAN DAN KESEJAHTERAAN PEKERJA               --}}
{{-- Tabel Gaji & Tunjangan — 25 Varian                          --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
    $rp = fn ($v) => number_format((float) $v, 0, ',', '.');
@endphp


{{-- ============================================================= --}}
{{-- GROUP 1 — Gaji Pokok + Tunj. Fungsional (All-In)            --}}
{{-- eni-civil-all-in, phss-major-ai-1, phss-humas               --}}
{{-- ============================================================= --}}
@if (in_array($type, ['eni-civil-all-in', 'phss-major-ai-1', 'phss-humas']))

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Fungsional</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>

    @if ($type === 'eni-civil-all-in')
        <ol type="a" class="mt-2">
            <li>Penggajian di atas sudah termasuk perhitungan apabila terjadi kelebihan jam kerja dan bekerja dihari libur.</li>
            <li>Apabila karyawan sedang stanby maka tidak mengurangi upah di atas.</li>
            <li>Apabila keryawan bekerja ke lokasi project maka tidak terhitung Dinas Luar, namun makan dan akomodasi akan disediakan.</li>
        </ol>
    @endif


{{-- ============================================================= --}}
{{-- GROUP 2 — Gaji + Kehadiran (Makan & Transport)               --}}
{{-- eni-smallcapital-reguler, eni-muara-bakau-lembur,            --}}
{{-- elis-phkt-5-2, phss-driver, phss-reguler,                    --}}
{{-- lawe-lawe-reguler                                           --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['eni-smallcapital-reguler', 'eni-muara-bakau-lembur', 'elis-phkt-5-2', 'phss-driver', 'phss-reguler', 'lawe-lawe-reguler']))

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Kehadiran (Makan &amp; Transport)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->attendance_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 3 — Gaji + Kemahalan + UM + UT + Fungsi               --}}
{{-- eni-civil-reguler                                           --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-civil-reguler')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Kemahalan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Makan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Fungsional</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>

    <ol type="a" class="mt-2">
        <li>Penggajian di atas sudah termasuk perhitungan apabila terjadi kelebihan jam kerja dan bekerja dihari libur.</li>
        <li>Apabila karyawan sedang stanby maka tidak mengurangi upah di atas.</li>
        <li>Apabila keryawan bekerja ke lokasi project maka tidak terhitung Dinas Luar, namun makan dan akomodasi akan disediakan.</li>
    </ol>


{{-- ============================================================= --}}
{{-- GROUP 4 — Gaji Pokok + Tunj. Jabatan (All-In)                --}}
{{-- eni-smallcapital-all-in, warlok-all-in, lawe-lawe-all-in    --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['eni-smallcapital-all-in', 'warlok-all-in', 'lawe-lawe-all-in']))

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">All – in Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Jabatan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->position_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">All – in Perbulan</td>
        </tr>
    </table>

    <p><strong>Catatan:</strong></p>
    <ol type="a" class="mt-2">
        <li>Penggajian di atas sudah termasuk perhitungan apabila terjadi kelebihan jam kerja (lembur) di hari kerja dan bekerja dihari off/ libur/ offday/ libur nasional.</li>
        <li>Pekerja bersedia bekerja jika diperintahkan oleh atasan/pimpinan saat hari kerja ataupun off/ libur/ libur nasional.</li>
        <li>Apabila Pekerja berada dalam status standby berdasarkan penugasan atau kebijakan Perusahaan, maka penghasilan (gaji all-in) tetap dibayarkan sesuai ketentuan dalam Perjanjian Kerja.</li>
    </ol>


{{-- ============================================================= --}}
{{-- GROUP 5 — Gaji + Fungsi + Makan + Transport (All-In)         --}}
{{-- phss-major-ai-2                                             --}}
{{-- ============================================================= --}}
@elseif ($type === 'phss-major-ai-2')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">All – in Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Fungsional</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">All – in Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Makan &amp; Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">All – in Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 6 — Gaji + Tunj. Jabatan (ENI Small Capital All In)    --}}
{{-- Hanya Gaji Pokok (PHSS Major Type 3, Schedule 5-2, dll)      --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['phss-major-ai-3', 'sched-5-2']))

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 7 — Security: Kehadiran + Insentif Khusus              --}}
{{-- warlok-security, phss-security                              --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['warlok-security', 'phss-security']))

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunjangan Kehadiran</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->attendance_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Kehadiran</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Insentif Khusus</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->security_incentive ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Kehadiran</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 8 — Sand Monitoring (Kompleks)                        --}}
{{-- sandmon-teknisi-1, sandmon-teknisi-2                        --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2']))

    @php
        // Hitung komponen Sand Monitoring
        $basic         = (float) ($c->basic_salary ?? 0);
        $housing       = (float) ($c->housing_allowance ?? 0);
        $transport     = (float) ($c->transport_allowance ?? 0);
        $ewhc          = (float) ($c->ewhc_allowance ?? 0);
        $daily         = (float) ($c->daily_allowance ?? 0);
        $annualLeave   = (float) ($c->annual_leave_allowance ?? 0);
        $severance     = (float) ($c->severance_allowance ?? 0);

        $thp           = $basic + $housing + $transport;     // 3A
        $total         = $thp + $ewhc;                        // 4A
        $deduction     = $thp * 0.04;                         // 5 = 4% dari THP
        $afterDeduction= $total - $deduction;                 // 5A
        $thr           = $thp / 12;                           // 6
        $annualLeaveCalc = $basic / 12;                       // 7 (dari Gaji Pokok / 12)
        // $annualLeave — pakai nilai dari input manual
        $grandTotal    = $afterDeduction + $thr + $annualLeave + $severance + $daily;
    @endphp

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td style="padding-right: 10px;">1.</td>
            <td class="data-label" style="width: auto;">Basic Salary (Gaji Pokok)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($basic) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">2.</td>
            <td class="data-label" style="width: auto;">Housing</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($housing) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">3.</td>
            <td class="data-label" style="width: auto;">Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($transport) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">3A.</td>
            <td class="data-label" style="width: auto;">THP (1+2+3)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($thp) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">4.</td>
            <td class="data-label" style="width: auto;">EWHC (3A x 65%)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($ewhc) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">4A.</td>
            <td class="data-label" style="width: auto;">Total (3A + 4)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($total) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">5.</td>
            <td class="data-label" style="width: auto;">Deduction / Asuransi (4% dari 3A)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($deduction) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">5A.</td>
            <td class="data-label" style="width: auto;">After Deduction (4A – 5)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($afterDeduction) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">6.</td>
            <td class="data-label" style="width: auto;">THR (3A : 12 bulan)</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($thr) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">7.</td>
            <td class="data-label" style="width: auto;">Annual Leave Allowance / Cuti</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($annualLeave) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">8.</td>
            <td class="data-label" style="width: auto;">Complement / Pesangon</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($severance) }}</strong></td>
        </tr>
        <tr>
            <td style="padding-right: 10px;">9.</td>
            <td class="data-label" style="width: auto;">Daily Allowance</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($daily) }}</strong></td>
        </tr>
        <tr style="border-top: 2px solid #000;">
            <td style="padding-right: 10px;">10.</td>
            <td class="data-label" style="width: auto;"><strong>Grand Total (5A+6+7+8+9)</strong></td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($grandTotal) }}</strong></td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 9 — Gaji Pokok saja (PEP Lokal Bunyu)                  --}}
{{-- pep-lokal-buny                                              --}}
{{-- ============================================================= --}}
@elseif ($type === 'pep-lokal-buny')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 10 — ELIS PHKT 5.2: Gaji + UM + UT + Laut              --}}
{{-- elis-phkt-5-2                                               --}}
{{-- ============================================================= --}}
@elseif ($type === 'elis-phkt-5-2')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Makan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Laut</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->sea_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja (Laut)</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 11 — ENI Muara Bakau All-In: Gaji + Makan + Transport + Pulsa + Fungsi --}}
{{-- eni-muara-bakau-all-in                                      --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-muara-bakau-all-in')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Makan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Pulsa</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->pulse_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunj. Fungsional</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- GROUP 12 — IPFMS Dobu (sama seperti ELIS PHKT 5.2)           --}}
{{-- ipfms-dobu                                                  --}}
{{-- ============================================================= --}}
@elseif ($type === 'ipfms-dobu')

    <table class="data-table" style="width: auto; margin: 6px auto 10px;">
        <tr>
            <td class="data-label" style="width: auto;">Gaji Pokok</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Makan</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Uang Transport</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td class="data-label" style="width: auto;">Tunjangan Laut</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Rp {{ $rp($c->sea_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja (Jika Laut)</td>
        </tr>
    </table>

@endif
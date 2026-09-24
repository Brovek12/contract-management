@php
    $type = $type ?? ($contract->type ?? null);
    $rp   = fn ($v) => number_format((float) $v, 0, ',', '.');
@endphp

@if ($type === 'all-in')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunjangan Projek</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->project_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>

    <ol type="a" class="mt-2">
        <li>Penggajian di atas sudah termasuk perhitungan apabila terjadi kelebihan jam kerja dan bekerja dihari libur.</li>
        <li>Apabila karyawan sedang stanby maka tidak mengurangi upah di atas.</li>
        <li>Apabila keryawan bekerja ke lokasi project maka tidak terhitung Dinas Luar, namun makan dan akomodasi akan disediakan.</li>
    </ol>

@elseif ($type === 'gp-mahal-um-ut-fungsi')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Kemahalan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Fungsional</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>

@elseif ($type === 'gp-mahal-um-ut-fungsi-pls')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Kemahalan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Fungsional</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Pulsa</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->pulse_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>

@elseif (in_array($type, ['gp-um-ut-fungsi', 'gp-um-ut']))

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        @if ($type === 'gp-um-ut-fungsi')
            <tr>
                <td>Tunj. Fungsional</td>
                <td>:</td>
                <td><strong>Rp {{ $rp($contract->functional_allowance ?? 0) }}</strong></td>
                <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
            </tr>
        @endif
    </table>

@elseif ($type === 'gp-um-ut-laut')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Laut</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->sea_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja (Laut)</td>
        </tr>
    </table>

    <ul class="mt-2">
        <li>Uang makan dan uang transport diberikan apabila Pekerja bekerja di office/workshop, dan lokasi tertentu yang tidak disediakan fasilitas makan dan transport.</li>
        <li>Uang makan dan transport tidak diberikan apabila fasilitas makan dan transport disediakan oleh perusahaan atau user.</li>
        <li>Tunjangan Laut hanya diberikan apabila Pekerja bekerja di Offshore</li>
    </ul>

@elseif ($type === 'gp-mahal-um-ut')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Kemahalan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Fungsional</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>

@elseif ($type === 'security')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Kemahalan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Insentif Khusus Security</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->security_incentive ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Shift Malam</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->night_shift_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja Shift Malam</td>
        </tr>
    </table>

@elseif ($type === 'ob')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Kemahalan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->cost_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>
    {{-- ============================================================= --}}
{{-- PROJECT: pep-lokal-buny --}}
{{-- ============================================================= --}}
@elseif ($type === 'pep-lokal-buny')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- PROJECT: elis-phkt-5-2 --}}
{{-- ============================================================= --}}
@elseif ($type === 'elis-phkt-5-2')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunj. Laut</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->sea_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja (Laut)</td>
        </tr>
    </table>

    <ul class="mt-2">
        <li>Uang makan dan uang transport diberikan apabila Pekerja bekerja di office/workshop, dan lokasi tertentu yang tidak disediakan fasilitas makan dan transport.</li>
        <li>Uang makan dan transport tidak diberikan apabila fasilitas makan dan transport disediakan oleh Perusahaan atau user.</li>
        <li>Tunjangan Laut hanya diberikan apabila Pekerja bekerja di Offshore</li>
    </ul>


{{-- ============================================================= --}}
{{-- PROJECT: elis-phkt-6-1 --}}
{{-- ============================================================= --}}
@elseif ($type === 'elis-phkt-6-1')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- PROJECT: eni-muara-bakau-lembur --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-muara-bakau-lembur')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Kehadiran (Makan & Transport)</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->attendance_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
    </table>


{{-- ============================================================= --}}
{{-- PROJECT: eni-muara-bakau-all-in --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-muara-bakau-all-in')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Pulsa</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->pulse_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Tunj. Fungsional</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->functional_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
    </table>

    <ol type="a" class="mt-2">
        <li>Penggajian di atas sudah termasuk perhitungan apabila terjadi kelebihan jam kerja dan bekerja dihari libur.</li>
        <li>Apabila karyawan sedang stanby maka tidak mengurangi upah di atas.</li>
        <li>Apabila keryawan bekerja ke lokasi project maka tidak terhitung Dinas Luar, namun makan dan akomodasi akan disediakan.</li>
    </ol>


{{-- ============================================================= --}}
{{-- PROJECT: ipfms-dobu --}}
{{-- ============================================================= --}}
@elseif ($type === 'ipfms-dobu')

    <table class="table-pasal" style="margin: 0 auto; width: auto;">
        <tr>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->basic_salary ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perbulan</td>
        </tr>
        <tr>
            <td>Uang Makan</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->meal_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->transport_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja</td>
        </tr>
        <tr>
            <td>Tunjangan Laut</td>
            <td>:</td>
            <td><strong>Rp {{ $rp($contract->sea_allowance ?? 0) }}</strong></td>
            <td style="padding-left: 20px;">Perhari Masuk Kerja (Jika Laut)</td>
        </tr>
    </table>

@else
    <p class="indent text-center">
        <strong>Gaji Pokok : Rp {{ $rp($contract->basic_salary ?? 0) }} Perbulan</strong>
    </p>
@endif
{{-- ========================================================= --}}
{{-- KATEGORI: PROJECT --}}
{{-- ========================================================= --}}
@if ($contract->category === 'project')

    <p>
        6. Gaji, dan Lembur (bila ada) dibayarkan pada tanggal <strong>09</strong> setiap bulannya, dengan
        periode perhitungan tanggal 01 -- 30/31 bulan sebelumnya, dengan ketentuan sebagai berikut:
    </p>

    <p class="indent">a. Apabila tanggal 09 jatuh pada hari Sabtu/Libur Nasional, maka Upah dibayarkan pada tanggal 08 (hari Jumat/hari sebelumnya)</p>
    <p class="indent">b. Apabila tanggal 09 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 10 (hari Senin)</p>

    <p>7. Potongan Ketidakhadiran dan Keterlambatan</p>

    <p class="indent">
        a. <strong>Pekerja</strong> yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak
        menunjukkan surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka
        dikategorikan <strong>Alpa</strong> dan upah akan dipotong dengan formula sebagai berikut:
    </p>

    <p class="formula">ALPA = Alpa X Gaji Pokok / 21</p>

    <p class="indent">
        b. <strong>Pekerja</strong> yang tidak masuk bekerja karena <strong>izin,</strong> maka wajib
        memberikan informasi kepada atasan serta membuat surat izin pada hari berikutnya. Perhitungan
        Potongan izin adalah sebagai berikut :
    </p>

    <p class="formula">IZIN = Gaji Pokok X Jumlah Izin X 50% / 21</p>

    <p class="indent">
        c. <strong>Pekerja</strong> yang tidak masuk bekerja karena <strong>sakit</strong>, maka wajib
        memberikan Informasi kepada atasan serta menunjukkan surat keterangan sakit dari dokter. Bagi
        yang tidak dapat menunjukkan surat Keterangan sakit dari dokter namun sudah menginformasikan
        kepada atasan maka Pekerja dianggap <strong>izin.</strong>
    </p>

    <p>8. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <ol type="a" style="margin-left: 20px;">
        <li>Apabila tanggal 09 jatuh pada hari Sabtu/Libur resmi, maka Upah akan dibayarkan pada tanggal 08 (hari sebelumnya).</li>
        <li>Apabila tanggal 09 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 10 (hari Senin).</li>
    </ol>

    <p>
        9. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh perusahaan untuk kemudian disetorkan
        ke Kas Negara.
    </p>

{{-- ========================================================= --}}
{{-- KATEGORI: MANAGERIAL --}}
{{-- ========================================================= --}}
@elseif ($contract->category === 'managerial' && $contract->type !== 'all-in')

    <p>
        6. Gaji, Tunjangan dan Piket (bila ada) dibayarkan setiap tanggal 25 setiap bulannya.
        Dengan periode Gaji dan Tunjangan mulai tanggal 26 bulan sebelumnya sampai tanggal 25 bulan selanjutnya
        dan

        @switch($contract->type)
            @case('gp-mahal-um-ut-fungsi')
                Tunjangan Kemahalan, Uang Makan, Uang Transportasi, Uang Tunjangan Fungsional
                @break

            @case('gp-um-ut-fungsi')
                Uang Makan, Uang Transportasi, Uang Tunjangan Fungsional
                @break

        @endswitch

        dan Piket
        tanggal 16 bulan sebelumnya sampai tanggal 15
        bulan selanjutnya.
    </p>

    <p>7. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <ol type="a" style="margin-left: 20px;">
        <li>Apabila tanggal 25 jatuh pada hari Sabtu/Libur resmi, maka Upah akan dibayarkan pada tanggal 24 (hari sebelumnya).</li>
        <li>Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</li>
    </ol>

    <p>
        8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh perusahaan untuk kemudian disetorkan
        ke Kas Negara.
    </p>


    @elseif ($contract->type === 'all-in')
    <p>
        6.	Gaji dan tunjangan dibayarkan setiap tanggal 25 setiap bulannya,ketentuan tanggal pembayaran Upah adalah sebagai berikut: </p>
        <p class="indent"> a. Apabila tanggal 25 jatuh pada hari Sabtu/Libur resmi, maka Upah akan dibayarkan pada tanggal 24 (hari sebelumnya).</p>
        <p class="indent"> b. Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</p>
        <p>7. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh perusahaan untuk kemudian disetorkan ke Kas Negara.</p>
{{-- ========================================================= --}}
{{-- KATEGORI: NON-MANAGERIAL --}}
{{-- ========================================================= --}}
@else

    <p>
        6. Gaji, Tunjangan dan Lembur (bila ada) dibayarkan setiap tanggal 25 setiap bulannya.
        Dengan periode Gaji dan Tunjangan mulai tanggal 26 bulan sebelumnya sampai tanggal 25 bulan selanjutnya
        dan

        @php
            $typesWithoutAllowance = ['pep-lokal-buny', 'elis-phkt-6-1'];
            $hasAllowance = !in_array($contract->type, $typesWithoutAllowance);
        @endphp

        @if ($hasAllowance)
            @switch($contract->type)

                @case('gp-um-ut')
                    Uang Makan, Uang Transportasi
                    @break

                @case('gp-um-ut-laut')
                    Uang Makan, Uang Transportasi, Tunjangan Laut
                    @break

                @case('gp-mahal-um-ut')
                    Tunjangan Kemahalan, Uang Makan, Uang Transportasi, Uang Tunjangan Fungsional
                    @break

                @case('gp-mahal-um-ut-fungsi-pls')
                    Tunjangan Kemahalan, Uang Makan, Uang Transportasi, Uang Tunjangan Fungsional, Tunjangan Pulsa
                    @break

                @case('security')
                    Tunjangan Kemahalan, Uang Makan, Uang Transportasi, Insentif Khusus Security, Shift Malam
                    @break

                @case('ob')
                    Tunjangan Kemahalan, Uang Makan, Uang Transportasi
                    @break

            @endswitch
        @endif

        dan Lembur
        tanggal 16 bulan sebelumnya sampai tanggal 15
        bulan selanjutnya.
    </p>

    <p>7. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <ol type="a" style="margin-left: 20px;">
        <li>Apabila tanggal 25 jatuh pada hari Sabtu/Libur resmi, maka Upah akan dibayarkan pada tanggal 24 (hari sebelumnya).</li>
        <li>Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</li>
    </ol>

    <p>
        8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh perusahaan untuk kemudian disetorkan
        ke Kas Negara.
    </p>

@endif
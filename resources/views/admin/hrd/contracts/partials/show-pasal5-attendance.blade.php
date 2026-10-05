
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
   
{{-- ========================================================= --}}
{{-- POIN 6 - 8: VERSI NON-MANAGERIAL --}}
{{-- ========================================================= --}}
@else

    <p>
        6. Gaji, Tunjangan - tunjangan dan Lembur (bila ada) dibayarkan setiap tanggal 25 setiap bulannya.
        Dengan periode Gaji dan Tunjangan mulai tanggal 26 bulan sebelumnya sampai tanggal 25 bulan selanjutnya
        dan uang makan, transport, tunjangan lokasi dan lembur tanggal 16 bulan sebelumnya sampai tanggal 15
        bulan selanjutnya.
    </p>

    <p>7. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <ol type="a" style="margin-left: 20px;">
        <li>Apabila tanggal 25 jatuh pada hari Sabtu/Libur resmi, maka Upah akan dibayarkan pada tanggal 24
            (hari sebelumnya).</li>
        <li>Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</li>
    </ol>

    <p>
        8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh perusahaan untuk kemudian disetorkan
        ke Kas Negara.
    </p>

@endif
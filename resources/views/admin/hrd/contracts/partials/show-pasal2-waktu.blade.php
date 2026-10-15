@php
    $type = $type ?? ($contract->type ?? null);
@endphp

@if ($type === 'security')

    {{-- ============================= --}}
    {{-- SECURITY --}}
    {{-- ============================= --}}
    <div class="pasal-title">PASAL 2</div>
    <div class="pasal-subtitle">HARI DAN JAM KERJA</div>

    <p>
        1. Hari dan jam kerja adalah 6 (Enam) hari kerja banding 1 (satu) hari libur,
        dengan ketentuan sebagai berikut :
    </p>
    <ul>
        <li>Siang : Jam 06.00 WITA s/d Jam 18.00 WITA</li>
        <li>Malam : Jam 18.00 WITA s/d Jam 06.00 WITA</li>
    </ul>
    <p>Waktu Istirahat 1 (Satu) Jam yang waktunya diatur tersendiri.</p>

    <p>
        2. Jam kerja di luar lokasi Workshop diberlakukan shift kerja, dengan ketentuan
        1 (satu) shift kerja sebanyak 12 (dua belas) jam dengan waktu istirahat 1 (satu) jam
        yang waktunya akan diatur kemudian.
    </p>

    <p>
        3. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan
        yang akan diatur kemudian.
    </p>

@elseif ($type === 'ob')

    {{-- ============================= --}}
    {{-- OB --}}
    {{-- ============================= --}}
    <div class="pasal-title">PASAL 2</div>
    <div class="pasal-subtitle">HARI DAN JAM KERJA</div>

    <p>
        1. Hari dan jam kerja dalam satu Minggu adalah 5 (Lima) hari dan jumlah jam kerja
        tidak melebihi 40 (empat puluh) jam seminggu, dengan ketentuan sebagai berikut :
    </p>
    <ul>
        <li>
            Senin s/d Kamis : Jam 07.00 WITA s/d Jam 16.00 WITA dengan waktu istirahat
            1 (satu) jam (Jam 12.00 WITA s/d Jam 13.00 WITA)
        </li>
        <li>
            Jum'at : Jam 07.00 WITA s/d Jam 16.00 WITA dengan waktu istirahat 2 (dua) jam
            (Jam 11.30 WITA s/d 13.30 WITA)
        </li>
        <li>Sabtu s/d Minggu : Libur</li>
    </ul>

    <p>
        2. Pekerja mengakui hak Perusahaan untuk mengatur hari kerja dan jam kerja serta
        kerja shift bagi semua pekerja dengan syarat jumlah jam kerja tidak melebihi
        40 jam dalam satu Minggu.
    </p>

    <p>
        3. Jam kerja di luar lokasi Workshop diberlakukan shift kerja, dengan ketentuan
        1 (satu) shift kerja sebanyak 12 (dua belas) jam yang waktunya akan diatur kemudian.
    </p>

    <p>
        4. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan
        yang akan diatur kemudian.
    </p>
@else

    {{-- ============================================ --}}
    {{-- DEFAULT — 5 hari kerja 08.00–17.00           --}}
    {{-- (managerial & project lain: PEP, ELIS 5.2,   --}}
    {{--  ENI Lembur, non-managerial lain)            --}}
    {{-- ============================================ --}}
    <div class="pasal-title">PASAL 2</div>
    <div class="pasal-subtitle">HARI DAN JAM KERJA</div>

    <p>
        1. Hari dan jam kerja dalam satu Minggu adalah 5 (Lima) hari dan jumlah jam kerja tidak
        melebihi 40 (empat puluh) jam seminggu, dengan ketentuan sebagai berikut :
    </p>

    <p class="indent">o Senin s/d Kamis : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 1 (satu) jam</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>

    <p class="indent">o Jum'at : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 2 (dua) jam</p>
    <p class="indent-2">Jam 11.30 WITA s/d 13.30 WITA</p>

    <p class="indent">o Sabtu s/d Minggu : Libur</p>

    <p>
        2. Pekerja mengakui hak Perusahaan untuk mengatur hari kerja dan jam kerja serta kerja shift
        bagi semua pekerja dengan syarat jumlah jam kerja tidak melebihi 40 jam dalam satu Minggu.
    </p>

    <p>
        3. Jam kerja di lokasi project atau di luar lokasi workshop sesuai dengan peraturan yang
        ditentukan oleh project atau user.
    </p>

    <p>
        4. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan yang akan
        diatur kemudian.
    </p>

@endif
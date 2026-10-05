 <div class="pasal-title">PASAL 3</div>
    <div class="pasal-subtitle">STATUS PEKERJA</div>
@if ($contract->category === 'non-managerial' || $contract->category === 'managerial')
      <p>
        Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai <strong>{{ $contract->position ?? '................' }}</strong>
        dengan Golongan
        <strong>{{ $contract->grade ?? '................' }}</strong> di PT Bukaka Teknik Utama Tbk
        cabang Balikpapan dan bersedia ditempatkan dilokasi
        <strong>{{ $contract->work_location ?? '................' }}</strong>
    </p>

@else
    <p>
        Perusahaan dengan ini menugaskan Pekerja untuk menjalankan tugasnya sebagai
        <strong>{{ $contract->position ?? '................' }}</strong> di PT Bukaka Teknik Utama Tbk
        cabang Balikpapan dan bersedia ditempatkan dilokasi
        <strong>{{ $contract->work_location ?? '................' }}</strong>
    </p>
    @endif
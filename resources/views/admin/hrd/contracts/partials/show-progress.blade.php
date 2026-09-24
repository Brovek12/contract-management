{{-- ============================================ --}}
{{-- PROGRESS STEPPER — Contract Status          --}}
{{-- Include: @include('employee.contracts._progress', ['contract' => $contract]) --}}
{{-- ============================================ --}}

@php
    $stages = [
        'viewed'      => ['label' => 'Dilihat',         'icon' => 'eye'],
        'signed'      => ['label' => 'Ditandatangani',  'icon' => 'sign'],
        'signed-hrd'  => ['label' => 'Disetujui HRD',   'icon' => 'check'],
        'signed-head' => ['label' => 'Selesai',         'icon' => 'flag'],
    ];

    $statusOrder = array_keys($stages);

    $statusMap = [
        'sent'        => -1,
        'viewed'      => 0,
        'signed'      => 1,
        'signed-hrd'  => 2,
        'signed-head' => 3,
        'expired'     => -1,
    ];

    $currentIndex = $statusMap[$contract->status] ?? -1;
@endphp

<style>
    /* ============================================
       STEPPER CONTAINER — selaras dengan A4
       ============================================ */
    .progress-stepper-wrap {
        max-width: 210mm;
        margin: 0 auto 20px;
        padding: 0 15mm;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .progress-stepper-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04),
                    0 4px 20px rgba(0, 0, 0, 0.06);
        padding: 22px 28px;
    }

    .progress-stepper-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .progress-stepper-title {
        font-size: 13px;
        font-weight: 600;
        color: #7E8299;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .progress-stepper-status {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        background: #F1F1F2;
        color: #7E8299;
    }

    .progress-stepper-status.is-active {
        background: #EEF6FF;
        color: #3E97FF;
    }

    .progress-stepper-status.is-done {
        background: #E8FFF3;
        color: #17C653;
    }

    /* ============================================
       STEPPER TRACK
       ============================================ */
    .stepper-track {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        padding: 6px 0;
    }

    .stepper-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
        z-index: 2;
    }

    /* garis penghubung */
    .stepper-track::before {
        content: '';
        position: absolute;
        top: 22px;
        left: calc(12.5% + 20px);
        right: calc(12.5% + 20px);
        height: 2px;
        background: #EAEAEC;
        z-index: 1;
    }

    .stepper-track.has-progress::before {
        background: linear-gradient(
            to right,
            #50CD89 0%,
            #50CD89 var(--progress, 0%),
            #EAEAEC var(--progress, 0%)
        );
    }

    /* ============================================
       CIRCLE
       ============================================ */
    .stepper-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F4F5F7;
        color: #B5B5C3;
        border: 3px solid #ffffff;
        box-shadow: 0 0 0 2px #EAEAEC;
        transition: all 0.3s ease;
        margin-bottom: 10px;
        position: relative;
    }

    .stepper-circle svg {
        width: 18px;
        height: 18px;
        stroke-width: 2.5;
    }

    .stepper-node.done .stepper-circle {
        background: #50CD89;
        color: #ffffff;
        box-shadow: 0 0 0 2px #50CD89;
    }

    .stepper-node.current .stepper-circle {
        background: #3E97FF;
        color: #ffffff;
        box-shadow: 0 0 0 2px #3E97FF,
                    0 0 0 6px rgba(62, 151, 255, 0.15);
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0%, 100% {
            box-shadow: 0 0 0 2px #3E97FF,
                        0 0 0 6px rgba(62, 151, 255, 0.15);
        }
        50% {
            box-shadow: 0 0 0 2px #3E97FF,
                        0 0 0 10px rgba(62, 151, 255, 0.05);
        }
    }

    /* ============================================
       LABEL
       ============================================ */
    .stepper-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #B5B5C3;
        text-align: center;
        line-height: 1.3;
        max-width: 110px;
    }

    .stepper-node.done .stepper-label {
        color: #50CD89;
    }

    .stepper-node.current .stepper-label {
        color: #3E97FF;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 640px) {
        .progress-stepper-wrap {
            padding: 0 12px;
        }
        .progress-stepper-card {
            padding: 18px 16px;
        }
        .stepper-label {
            font-size: 11px;
            max-width: 80px;
        }
        .stepper-circle {
            width: 36px;
            height: 36px;
        }
        .stepper-circle svg {
            width: 15px;
            height: 15px;
        }
        .stepper-track::before {
            top: 18px;
        }
    }
</style>

@php
    // Hitung progress untuk gradient garis
    $totalStages = count($stages);
    if ($currentIndex < 0) {
        $progressPercent = 0;
    } elseif ($currentIndex >= $totalStages - 1) {
        $progressPercent = 100;
    } else {
        $progressPercent = ($currentIndex / ($totalStages - 1)) * 100;
    }

    // Status text
    $statusTextMap = [
        'sent'        => ['Belum Dibuka',           'is-active'],
        'viewed'      => ['Menunggu Tanda Tangan',  'is-active'],
        'signed'      => ['Menunggu Verifikasi HRD','is-active'],
        'signed-hrd'  => ['Menunggu Approval Head', 'is-active'],
        'signed-head' => ['Selesai',                'is-done'],
        'expired'     => ['Kontrak Berakhir',       ''],
    ];
    [$statusText, $statusClass] = $statusTextMap[$contract->status] ?? ['-', ''];
@endphp

<div class="progress-stepper-wrap">
    <div class="progress-stepper-card">

        {{-- Header --}}
        <div class="progress-stepper-header">
            <h4 class="progress-stepper-title">Progress Kontrak</h4>
            <span class="progress-stepper-status {{ $statusClass }}">
                {{ $statusText }}
            </span>
        </div>

        {{-- Stepper --}}
        <div class="stepper-track {{ $progressPercent > 0 ? 'has-progress' : '' }}"
             style="--progress: {{ $progressPercent }}%;">

            @foreach ($stages as $key => $stage)
                @php
                    $index = array_search($key, $statusOrder);

                    if ($index < $currentIndex) {
                        $stateClass = 'done';
                    } elseif ($index === $currentIndex) {
                        $stateClass = 'current';
                    } else {
                        $stateClass = 'pending';
                    }
                @endphp

                <div class="stepper-node {{ $stateClass }}">

                    <div class="stepper-circle">
                        @if ($stateClass === 'done')
                            {{-- checkmark --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        @elseif ($stage['icon'] === 'eye')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        @elseif ($stage['icon'] === 'sign')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                                <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                                <path d="M2 2l7.586 7.586"></path>
                                <circle cx="11" cy="11" r="2"></circle>
                            </svg>
                        @elseif ($stage['icon'] === 'check')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        @elseif ($stage['icon'] === 'flag')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                                <line x1="4" y1="22" x2="4" y2="15"></line>
                            </svg>
                        @endif
                    </div>

                    <div class="stepper-label">{{ $stage['label'] }}</div>

                </div>
            @endforeach

        </div>
    </div>
</div>
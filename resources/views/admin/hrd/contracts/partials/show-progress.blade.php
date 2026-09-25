{{-- ============================================ --}}
{{-- PROGRESS STEPPER — Contract Status (Floating Compact Top + Collapsible) --}}
{{-- Include: @include('employee.contracts._progress', ['contract' => $contract]) --}}
{{-- ============================================ --}}

@php
    $stages = [
        'viewed'      => ['label' => 'Dilihat',        'icon' => 'eye'],
        'signed'      => ['label' => 'Ditandatangani', 'icon' => 'sign'],
        'signed-hrd'  => ['label' => 'Disetujui HRD',  'icon' => 'check'],
        'signed-head' => ['label' => 'Selesai',        'icon' => 'flag'],
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

    $totalStages = count($stages);
    if ($currentIndex < 0) {
        $progressPercent = 0;
    } elseif ($currentIndex >= $totalStages - 1) {
        $progressPercent = 100;
    } else {
        $progressPercent = ($currentIndex / ($totalStages - 1)) * 100;
    }

    $statusTextMap = [
        'sent'        => ['Belum Dibuka',            'is-active'],
        'viewed'      => ['Menunggu Tanda Tangan',   'is-active'],
        'signed'      => ['Menunggu Verifikasi HRD', 'is-active'],
        'signed-hrd'  => ['Menunggu Approval Head',  'is-active'],
        'signed-head' => ['Selesai',                 'is-done'],
        'expired'     => ['Kontrak Berakhir',        ''],
    ];
    [$statusText, $statusClass] = $statusTextMap[$contract->status] ?? ['-', ''];
@endphp

<style>
    /* ============================================
       FLOATING WRAPPER — TOP + COLLAPSIBLE
       ============================================ */
    .progress-stepper-float {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1040;
        width: calc(100% - 24px);
        max-width: 420px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        pointer-events: none;
    }

    .progress-stepper-card {
        pointer-events: auto;
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 14px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.10),
                    0 2px 6px rgba(0, 0, 0, 0.04);
        padding: 10px 14px 12px;
        cursor: pointer;
        user-select: none;
        transition:
            padding 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            border-radius 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s ease,
            transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .progress-stepper-card:hover {
        box-shadow: 0 10px 32px rgba(0, 0, 0, 0.12),
                    0 2px 8px rgba(0, 0, 0, 0.05);
        transform: translateY(-1px);
    }

    .progress-stepper-card:active {
        transform: scale(0.985);
    }

    /* ============================================
       HEADER
       ============================================ */
    .progress-stepper-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
        transition: margin-bottom 0.3s ease;
    }

    .progress-stepper-title {
        font-size: 10px;
        font-weight: 600;
        color: #9A9CAE;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Chevron toggle */
    .progress-stepper-chevron {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        color: #B5B5C3;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .progress-stepper-chevron svg {
        width: 12px;
        height: 12px;
        stroke-width: 2.5;
    }

    .progress-stepper-card.is-collapsed .progress-stepper-chevron {
        transform: rotate(-90deg);
    }

    .progress-stepper-status {
        font-size: 10px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 20px;
        background: #F1F1F2;
        color: #7E8299;
        white-space: nowrap;
        transition: all 0.3s ease;
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
       BODY (collapsible area)
       ============================================ */
    .progress-stepper-body {
        max-height: 120px;
        opacity: 1;
        transition:
            max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.25s ease 0.1s,
            margin-top 0.3s ease;
        overflow: hidden;
    }

    .progress-stepper-card.is-collapsed .progress-stepper-body {
        max-height: 0;
        opacity: 0;
        transition:
            max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.15s ease;
    }

    .progress-stepper-card.is-collapsed {
        padding: 8px 14px 8px;
        border-radius: 20px;
    }

    .progress-stepper-card.is-collapsed .progress-stepper-header {
        margin-bottom: 0;
    }

    /* ============================================
       STEPPER TRACK
       ============================================ */
    .stepper-track {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        padding: 2px 0;
    }

    .stepper-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .stepper-track::before {
        content: '';
        position: absolute;
        top: 13px;
        left: calc(12.5% + 14px);
        right: calc(12.5% + 14px);
        height: 2px;
        background: #EAEAEC;
        z-index: 1;
        border-radius: 2px;
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
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F4F5F7;
        color: #B5B5C3;
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 1.5px #EAEAEC;
        transition: all 0.25s ease;
        margin-bottom: 5px;
        position: relative;
    }

    .stepper-circle svg {
        width: 12px;
        height: 12px;
        stroke-width: 2.8;
    }

    .stepper-node.done .stepper-circle {
        background: #50CD89;
        color: #ffffff;
        box-shadow: 0 0 0 1.5px #50CD89;
    }

    .stepper-node.current .stepper-circle {
        background: #3E97FF;
        color: #ffffff;
        box-shadow: 0 0 0 1.5px #3E97FF,
                    0 0 0 4px rgba(62, 151, 255, 0.15);
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0%, 100% {
            box-shadow: 0 0 0 1.5px #3E97FF,
                        0 0 0 4px rgba(62, 151, 255, 0.15);
        }
        50% {
            box-shadow: 0 0 0 1.5px #3E97FF,
                        0 0 0 7px rgba(62, 151, 255, 0.05);
        }
    }

    /* ============================================
       LABEL
       ============================================ */
    .stepper-label {
        font-size: 9px;
        font-weight: 600;
        color: #B5B5C3;
        text-align: center;
        line-height: 1.2;
        max-width: 70px;
        letter-spacing: -0.1px;
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
    @media (max-width: 480px) {
        .progress-stepper-float {
            top: 10px;
            width: calc(100% - 16px);
        }
        .progress-stepper-card {
            padding: 8px 10px 10px;
            border-radius: 12px;
        }
        .progress-stepper-card.is-collapsed {
            padding: 7px 12px;
            border-radius: 18px;
        }
        .stepper-circle {
            width: 24px;
            height: 24px;
        }
        .stepper-circle svg {
            width: 10px;
            height: 10px;
        }
        .stepper-track::before {
            top: 11px;
        }
        .stepper-label {
            font-size: 8px;
            max-width: 58px;
        }
    }

    /* Padding atas body agar konten tidak tertutup */
    body {
        padding-top: 110px;
        transition: padding-top 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    body.stepper-collapsed {
        padding-top: 60px;
    }
    @media (max-width: 480px) {
        body {
            padding-top: 96px;
        }
        body.stepper-collapsed {
            padding-top: 54px;
        }
    }
</style>

<div class="progress-stepper-float" id="progressStepperFloat">
    <div class="progress-stepper-card" id="progressStepperCard" role="button" tabindex="0" aria-expanded="true">

        {{-- Header --}}
        <div class="progress-stepper-header">
            <h4 class="progress-stepper-title">
                <span class="progress-stepper-chevron">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </span>
                Progress Kontrak
            </h4>
            <span class="progress-stepper-status {{ $statusClass }}">
                {{ $statusText }}
            </span>
        </div>

        {{-- Body --}}
        <div class="progress-stepper-body">
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
</div>

<script>
(function () {
    const card = document.getElementById('progressStepperCard');
    const body = document.body;
    if (!card) return;

    // Ambil state dari localStorage (biar ingat posisi terakhir)
    const STORAGE_KEY = 'progressStepperCollapsed';
    const saved = localStorage.getItem(STORAGE_KEY);

    if (saved === '1') {
        card.classList.add('is-collapsed');
        card.setAttribute('aria-expanded', 'false');
        body.classList.add('stepper-collapsed');
    }

    function toggle() {
        const collapsed = card.classList.toggle('is-collapsed');
        card.setAttribute('aria-expanded', collapsed ? 'false' : 'true');

        if (collapsed) {
            body.classList.add('stepper-collapsed');
        } else {
            body.classList.remove('stepper-collapsed');
        }

        localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
    }

    // Klik
    card.addEventListener('click', toggle);

    // Keyboard accessibility (Enter / Space)
    card.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggle();
        }
    });
})();
</script>
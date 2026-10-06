<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>404 - Halaman Tidak Ditemukan</title>

    <link
        rel="shortcut icon"
        href="{{ asset('images/bukaka1.png') }}" />

    <link
        rel="stylesheet"
        href="{{ asset('assets/plugins/global/plugins.bundle.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/style.bundle.css') }}">

    <style>

        body {
            background-color: #f5f8fa;
        }

        .error-wrapper {
            min-height: 100vh;
        }

        .error-card {
            width: 650px;
            max-width: 92%;
        }

        .error-icon-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: rgba(54, 153, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-icon-wrapper i {
            font-size: 65px;
            color: #3699ff;
        }

        .error-code {
            font-size: 100px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -5px;
            color: #181c32;
        }

        .info-warning {
            background-color: #f0f8ff;
            border: 1px dashed #3699ff;
            border-radius: 8px;
        }

        .info-warning-title {
            color: #3699ff;
            font-weight: 700;
        }

        .info-warning-text {
            color: #5e6278;
            font-size: 13px;
            line-height: 1.7;
        }

        .info-footer {
            color: #a1a5b7;
            font-size: 12px;
        }

        /* =====================================================
           COUNTDOWN — card besar & menonjol
           ===================================================== */
        .countdown-card {
            background: linear-gradient(180deg, #f0f8ff 0%, #ffffff 100%);
            border: 1px solid #cbe5ff;
            border-radius: 14px;
            padding: 22px 24px 18px;
            margin-bottom: 22px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .countdown-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3699ff 0%, #8ac7ff 100%);
        }

        .countdown-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #5e6278;
            margin-bottom: 12px;
        }

        .countdown-label i {
            color: #3699ff;
            font-size: 14px;
            margin-right: 4px;
        }

        /* Angka countdown besar */
        .countdown-big {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid #3699ff;
            color: #3699ff;
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 14px;
            position: relative;
            box-shadow:
                0 0 0 8px rgba(54, 153, 255, 0.08),
                0 0 0 16px rgba(54, 153, 255, 0.04);
            transition: transform 0.3s ease;
        }

        .countdown-big.pulse {
            animation: countdownPulse 1s ease-out;
        }

        @keyframes countdownPulse {
            0%   { transform: scale(1); }
            50%  { transform: scale(1.12); }
            100% { transform: scale(1); }
        }

        .countdown-subtext {
            font-size: 13px;
            color: #5e6278;
            margin-bottom: 12px;
        }

        .countdown-subtext strong {
            color: #181c32;
        }

        /* Progress bar */
        .countdown-progress {
            width: 100%;
            height: 6px;
            background: #e8eef5;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 4px;
        }

        .countdown-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3699ff 0%, #8ac7ff 100%);
            border-radius: 6px;
            width: 100%;
            transition: width 1s linear;
        }

        @media (max-width: 576px) {

            .error-code {
                font-size: 75px;
            }

            .error-icon-wrapper {
                width: 95px;
                height: 95px;
            }

            .error-icon-wrapper i {
                font-size: 50px;
            }

            .countdown-big {
                width: 76px;
                height: 76px;
                font-size: 34px;
            }

            .countdown-card {
                padding: 18px 18px 14px;
            }

        }

    </style>

</head>


<body>

<div class="error-wrapper d-flex flex-column flex-center">

    <div class="error-card text-center">

        {{-- Not Found Icon --}}
        <div class="error-icon-wrapper mb-8">
            <i class="ki-duotone ki-magnifier">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>

        {{-- Error Code --}}
        <div class="error-code mb-5">
            404
        </div>

        {{-- Title --}}
        <h1 class="fw-bolder text-gray-900 mb-4">
            HALAMAN TIDAK DITEMUKAN
        </h1>

        {{-- Description --}}
        <div class="text-gray-600 fs-5 lh-lg mb-8">
            Halaman yang Anda cari tidak tersedia,
            <br>
            atau sudah dipindahkan ke lokasi lain.
        </div>

        {{-- Info Box --}}
        <div class="info-warning text-start p-5 mb-7">

            <div class="d-flex align-items-start">

                <i class="ki-duotone ki-information-5 text-primary fs-2x me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>

                <div>
                    <div class="info-warning-title mb-2">
                        INFORMASI
                    </div>

                    <div class="info-warning-text">
                        Pastikan URL yang Anda masukkan sudah benar.

                        <strong class="text-gray-800">
                            Jika Anda yakin halaman ini seharusnya ada,
                            silakan hubungi administrator sistem
                            untuk bantuan lebih lanjut.
                        </strong>
                    </div>
                </div>

            </div>

        </div>

        {{-- ================= COUNTDOWN CARD ================= --}}
        <div class="countdown-card">

            <div class="countdown-label">
                <i class="ki-outline ki-time"></i>
                Auto Redirect
            </div>

            <div class="countdown-big" id="countdownNumber">5</div>

            <div class="countdown-subtext">
                Mengalihkan ke <strong>Dashboard</strong> secara otomatis
            </div>

            <div class="countdown-progress">
                <div class="countdown-progress-bar" id="countdownBar"></div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="info-footer mb-7">
            <i class="ki-outline ki-shield-tick me-1"></i>
            Bukaka Balikpapan Brench &mdash; Contract Management System
        </div>

        {{-- Back Button --}}
        <div>
            <a href="{{ url('/') }}" class="btn btn-primary px-8">
                <i class="ki-outline ki-arrow-left fs-3 me-2"></i>
                Kembali ke Dashboard
            </a>
        </div>

    </div>

</div>


<script>

    (function () {

        var seconds = 5;
        var total = seconds;

        var countdownEl = document.getElementById('countdownNumber');
        var progressEl  = document.getElementById('countdownBar');
        var redirectUrl = "{{ url('/') }}";

        // Set progress awal penuh
        if (progressEl) {
            progressEl.style.width = '100%';
        }

        var timer = setInterval(function () {

            seconds--;

            // Update angka
            if (countdownEl) {
                countdownEl.textContent = seconds;

                // Efek pulse tiap detik
                countdownEl.classList.remove('pulse');
                void countdownEl.offsetWidth; // force reflow
                countdownEl.classList.add('pulse');
            }

            // Update progress bar
            if (progressEl) {
                var percent = (seconds / total) * 100;
                progressEl.style.width = percent + '%';
            }

            // Redirect
            if (seconds <= 0) {
                clearInterval(timer);
                window.location.href = redirectUrl;
            }

        }, 1000);

    })();

</script>

</body>

</html>
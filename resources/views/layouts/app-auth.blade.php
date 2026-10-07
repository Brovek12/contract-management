<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bukaka - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/bukaka1.png') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* =====================================================
           AUTH LAYOUT — FULL SCREEN BACKGROUND + CENTERED CARD
           ===================================================== */

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            height: 100%;
        }

        /* Wrapper utama full screen */
        .auth-wrapper {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;

            /* Background image */
            background-image: url('{{ asset('images/bg-login.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Overlay gelap/biru transparan supaya form tetap terbaca */
        .auth-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(22, 133, 199, 0.55) 0%,
                rgba(15, 45, 80, 0.65) 100%
            );
            z-index: 1;
        }

        /* Card login di tengah */
        .auth-card {
            position: relative;
            z-index: 2;
            background: #ffffff;
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.25),
                0 4px 16px rgba(0, 0, 0, 0.1);
        }

        /* =====================================================
           RESPONSIVE
           ===================================================== */
        @media (max-width: 576px) {
            .auth-wrapper {
                padding: 16px;
                background-attachment: scroll;
            }

            .auth-card {
                padding: 32px 24px;
                border-radius: 16px;
                max-width: 100%;
            }
        }

        @media (max-width: 400px) {
            .auth-card {
                padding: 26px 20px;
            }
        }
    </style>

    @yield('style')
</head>

<body id="kt_body">

    <!-- Theme mode setup -->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <!-- AUTH WRAPPER -->
    <div class="auth-wrapper">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>

    <!-- Global JS Bundle -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    @yield('script')
</body>

</html>
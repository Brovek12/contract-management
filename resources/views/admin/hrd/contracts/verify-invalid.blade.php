<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukaka - Invalid Token</title>

    <link rel="shortcut icon" href="{{ asset('images/bukaka1.png') }}" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f5f8fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .invalid-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(30, 108, 180, 0.08);
            border: 1px solid #e8eef5;
            padding: 40px 32px 28px;
            max-width: 460px;
            width: 100%;
            text-align: center;
        }

        /* ============ BRAND ============ */
        .invalid-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 28px;
        }

        .invalid-brand img {
            height: 32px;
            width: auto;
            object-fit: contain;
        }

        .invalid-brand-name {
            color: #1e6cb4;
            font-weight: 700;
            font-size: 18px;
        }

        /* ============ ICON ============ */
        .invalid-icon {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #fee2e2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
            position: relative;
        }

        .invalid-icon::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px dashed #fecaca;
            opacity: 0.6;
        }

        .invalid-icon i {
            font-size: 38px;
            color: #dc2626;
        }

        /* ============ TEXT ============ */
        .invalid-card h1 {
            font-size: 20px;
            font-weight: 700;
            color: #991b1b;
            margin: 0 0 10px;
            letter-spacing: -0.01em;
        }

        .invalid-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 26px;
        }

        /* ============ FOOTER ============ */
        .invalid-footer {
            font-size: 11.5px;
            color: #94a3b8;
            padding-top: 22px;
            border-top: 1px solid #f1f5f9;
        }

        .invalid-footer strong {
            color: #1e6cb4;
            font-weight: 600;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 480px) {
            .invalid-card {
                padding: 32px 22px 22px;
            }

            .invalid-brand img {
                height: 28px;
            }

            .invalid-brand-name {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="invalid-card">

    {{-- BRAND --}}
    <a href="https://bukakablp.com" target="_blank" class="invalid-brand">
        <img src="{{ asset('assets/media/logos/bukaka1.png') }}"
             alt="Bukaka">
        <span class="invalid-brand-name">Bukaka</span>
    </a>

    {{-- ICON --}}
    <div class="invalid-icon">
        <i class="ki-outline ki-shield-cross"></i>
    </div>

    {{-- TITLE --}}
    <h1>Invalid Token</h1>

    {{-- MESSAGE --}}
    <p>
        QR Code tidak dikenali atau sudah tidak berlaku.
        <br>
        Pastikan Anda memindai QR dari dokumen yang sah.
    </p>

    {{-- FOOTER --}}
    <div class="invalid-footer">
        Powered by <strong>Bukaka Balikpapan Brench</strong>
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>
</html>
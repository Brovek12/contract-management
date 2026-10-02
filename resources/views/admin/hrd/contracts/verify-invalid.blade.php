<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalid Token — Verifikasi Contract</title>

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f5f8fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .invalid-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 44px 32px;
            max-width: 460px;
            width: 100%;
            text-align: center;
        }

        .invalid-icon {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #fee2e2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .invalid-icon i {
            font-size: 38px;
            color: #dc2626;
        }

        .invalid-card h1 {
            font-size: 20px;
            font-weight: 700;
            color: #991b1b;
            margin-bottom: 10px;
        }

        .invalid-card p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 26px;
        }

        .branding {
            font-size: 11.5px;
            color: #9ca3af;
            padding-top: 22px;
            border-top: 1px solid #f3f4f6;
        }
    </style>
</head>
<body>

<div class="invalid-card">
    <div class="invalid-icon">
        <i class="ki-outline ki-shield-cross"></i>
    </div>

    <h1>Invalid Token</h1>

    <p>
        QR Code tidak dikenali atau sudah tidak berlaku.
        <br>
        Pastikan Anda memindai QR dari dokumen yang sah.
    </p>

    <div class="branding">
        Powered by {{ config('app.name') }}
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>
</html>
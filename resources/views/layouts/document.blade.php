<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Document')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/bukaka1.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            background: #e5e5e5;
            color: #000;
            font-family: "Times New Roman", Times, serif;
        }

        .document-container {
            width: 100%;
            padding: 30px 0;
        }

        .document-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px;
            padding: 15mm 20mm 25mm;
            background: #ffffff;
            position: relative;
            overflow: visible; /* ⬅ DIUBAH: jangan clip konten yang meluber */

            display: flex;
            flex-direction: column;
        }

        .document-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 8px;
            border-bottom: 1px solid #000;
            margin-bottom: 18px;
            flex-shrink: 0;

            /* ⬅ TAMBAHAN: header tidak boleh terpotong dari isinya */
            page-break-after: avoid;
            break-after: avoid;
        }

        .document-header-logo { width: 42%; display: flex; align-items: center; }
        .document-header-logo img { width: 150px; height: auto; display: block; }

        .document-header-info {
            width: 58%;
            text-align: right;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.25;
        }

        .document-header-company {
            font-size: 15px;
            font-weight: bold;
            color: #1685c7;
            margin-bottom: 2px;
        }

        .document-header-text { font-size: 10px; color: #222; }

        .document-footer {
            width: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding-top: 6px;
            border-top: 1px solid #000;
            margin-top: auto; /* ⬅ DIUBAH: didorong ke bawah, bukan jarak tetap */
            flex-shrink: 0;

            font-family: "Arial Narrow", Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;

            /* ⬅ TAMBAHAN */
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .document-footer-info { width: 60%; text-align: left; color: #000; }
        .document-footer-info .footer-branch { font-style: italic; font-weight: bold; margin-bottom: 1px; }
        .document-footer-info .footer-address { display: block; }
        .document-footer-info .footer-phone { display: block; }

        .document-footer-logos {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }
        .document-footer-logos img { height: 14mm; width: auto; object-fit: contain; }

        .page-number {
            position: absolute;
            top: 6mm;
            right: 10mm;
            font-size: 9pt;
        }

        /* ⬇ TAMBAHAN GLOBAL: cegah elemen penting terpotong pas ganti halaman */
        table,
        .paraf-table,
        .data-table,
        .signature-wrapper,
        .pasal-title,
        .pasal-subtitle {
            page-break-inside: avoid;
            break-inside: avoid;
        }
        .pasal-title {
            page-break-after: avoid;
            break-after: avoid;
        }

        @media print {

            @page {
                size: A4 portrait;
                margin: 0;
            }

            html, body {
                width: 210mm;
                margin: 0;
                padding: 0;
                background: #fff !important;
            }

            .document-container {
                width: 210mm;
                padding: 0;
            }

            .document-page {
                width: 210mm;
                min-height: 297mm;
                margin: 0;
                padding: 15mm 20mm 25mm;
                background: #fff;

                page-break-after: always;
                break-after: page;

                overflow: visible; /* ⬅ pastikan tidak ke-clip saat print juga */
            }

            .document-page:last-child {
                page-break-after: auto;
                break-after: auto;
            }

            .floating-sign-btn,
            .modal,
            .modal-backdrop {
                display: none !important;
            }
        }

    </style>

    @yield('document-style')

</head>

<body>

    <div class="document-container">
        <div class="document-content">
            @yield('document-content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

</body>

</html>
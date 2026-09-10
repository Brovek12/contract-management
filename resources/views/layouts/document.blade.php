<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Document')
    </title>
        <link rel="icon"
          type="image/png"
          href="{{ asset('images/bukaka1.png') }}">



    {{-- Bootstrap CSS untuk modal --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <style>

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
        }


        body {
            background: #e5e5e5;
            color: #000;
            font-family: "Times New Roman", Times, serif;
        }


        /* =====================================================
           DOCUMENT CONTAINER
        ===================================================== */

        .document-container {
            width: 100%;
            padding: 30px 0;
        }


        /* =====================================================
           A4 PAPER
        ===================================================== */

        .document-page {
            width: 210mm;
            min-height: 297mm;

            margin: 0 auto 30px;

            /* ✅ Beri ruang untuk header & footer */
            padding: 15mm 20mm 25mm;

            background: #ffffff;

            position: relative;
            overflow: hidden;

            /* ✅ Flex column biar paraf bisa dorong ke bawah */
            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           HEADER / KOP SURAT
        ===================================================== */

        .document-header {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding-bottom: 8px;

            border-bottom: 1px solid #000;

            margin-bottom: 18px;

            flex-shrink: 0;
        }


        .document-header-logo {
            width: 42%;
            display: flex;
            align-items: center;
        }


        .document-header-logo img {
            width: 150px;
            height: auto;
            display: block;
        }


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


        .document-header-text {
            font-size: 10px;
            color: #222;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .document-footer {
            width: 100%;

            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            padding-top: 6px;

            border-top: 1px solid #000;

            margin-top: 10mm;

            flex-shrink: 0;

            font-family: "Arial Narrow", Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;
        }


        /* Info kiri (alamat) */
        .document-footer-info {
            width: 60%;
            text-align: left;
            color: #000;
        }

        .document-footer-info .footer-branch {
            font-style: italic;
            font-weight: bold;
            margin-bottom: 1px;
        }

        .document-footer-info .footer-address {
            display: block;
        }

        .document-footer-info .footer-phone {
            display: block;
        }


        /* Logo kanan */
        .document-footer-logos {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .document-footer-logos img {
            height: 14mm;
            width: auto;
            object-fit: contain;
        }


        /* =====================================================
           PAGE NUMBER (override dari child)
        ===================================================== */

        .page-number {
            position: absolute;
            top: 6mm;
            right: 10mm;
            font-size: 9pt;
        }


        /* =====================================================
           PRINT
        ===================================================== */

        @media print {

            @page {
                size: A4 portrait;
                margin: 0;
            }


            html,
            body {
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

                overflow: visible;
            }


            .document-page:last-child {
                page-break-after: auto;
                break-after: auto;
            }


            /* Hide floating button & modal */
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


    {{-- =========================================================
        HEADER TEMPLATE — Auto inject ke setiap .document-page
    ========================================================= --}}
    <template id="document-header-template">
        <div class="document-header">
            <div class="document-header-logo">
                <img src="{{ asset('images/bukakaDoc.png') }}" alt="BUKAKA">
            </div>
            <div class="document-header-info">
                <div class="document-header-company">PT BUKAKA TEKNIK UTAMA Tbk</div>
                <div class="document-header-text">Bukaka Industrial Estate - Jl. Raya Narogong – Bekasi km 19,5</div>
                <div class="document-header-text">Cileungsi, Kab. Bogor 16820, Jawa Barat – Indonesia</div>
                <div class="document-header-text">Phone: +62 21 8232323 | Website: www.bukaka.com</div>
            </div>
        </div>
    </template>


    {{-- =========================================================
        FOOTER TEMPLATE — Auto inject ke setiap .document-page
    ========================================================= --}}
    <template id="document-footer-template">
        <div class="document-footer">

            <div class="document-footer-info">

                <div class="footer-branch">
                    Cabang Balikpapan | Office &amp; Workshop :
                </div>

                <span class="footer-address">
                    Jl. Mulawarman Km 21 Manggar
                </span>

                <span class="footer-address">
                    Balikpapan 76116, Kalimantan Timur – INDONESIA
                </span>

                <span class="footer-phone">
                    Phone : +62 542 743 312 (hunting) | Fax: +62 542 743 319
                </span>

            </div>


            <div class="document-footer-logos">
                <img src="{{ asset('images/footer-1.png') }}" alt="NQA">
            </div>

        </div>
    </template>


    <div class="document-container">

        <div class="document-content">
            @yield('document-content')
        </div>

    </div>


    {{-- =========================================================
        BOOTSTRAP JS
    ========================================================= --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- =========================================================
        AUTO INJECT HEADER & FOOTER
    ========================================================= --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const headerTemplate = document.getElementById('document-header-template');
        const footerTemplate = document.getElementById('document-footer-template');

        const headerHTML = headerTemplate ? headerTemplate.innerHTML : '';
        const footerHTML = footerTemplate ? footerTemplate.innerHTML : '';

        document.querySelectorAll('.document-page').forEach(function (page) {

            // ---------- HEADER ----------
            if (headerHTML && !page.querySelector('.document-header')) {
                page.insertAdjacentHTML('afterbegin', headerHTML);
            }

            // ---------- FOOTER ----------
            if (footerHTML && !page.querySelector('.document-footer')) {

                // Taruh footer setelah .paraf-table (kalau ada)
                const parafTable = page.querySelector('.paraf-table');

                if (parafTable) {
                    parafTable.insertAdjacentHTML('afterend', footerHTML);
                } else {
                    // Kalau tidak ada paraf, taruh di akhir
                    page.insertAdjacentHTML('beforeend', footerHTML);
                }
            }

        });

    });
    </script>


    @stack('scripts')

</body>

</html>  
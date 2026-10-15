<style>
    /* =========================================================
       RESET & BASE
    ========================================================= */
    .document-page,
    .document-page * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0 !important;
        padding: 0 !important;
        background: #e5e5e5 !important;
    }

    /* =========================================================
       A4 PAGE — FLEX LAYOUT + PADDING
    ========================================================= */
    .document-page {
        width: 210mm !important;
        min-height: 297mm !important;

        margin: 0 auto 20px !important;

        background: #ffffff;

        display: flex;
        flex-direction: column;

        padding: 15mm;

        position: relative;

        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;

        color: #000;

        counter-increment: page-number;
    }

    /* Nomor halaman otomatis via CSS counter */
    .document-page::after {
        content: counter(page-number);
        position: absolute;
        top: 6mm;
        right: 10mm;
        font-size: 9pt;
        font-family: "Arial Narrow", Arial, sans-serif;
        color: #000;
    }

    /* Reset counter di halaman pertama */
    .document-page:first-of-type {
        counter-reset: page-number 0;
    }

    /* Sembunyikan .page-number manual (kalau masih ada) */
    .page-number {
        display: none !important;
    }

    /* =========================================================
       PAGE BREAK CONTROL
    ========================================================= */
    .document-page p,
    .document-page ol,
    .document-page ul,
    .document-page h3,
    .document-page .paraf-table {
        page-break-inside: avoid;
        break-inside: avoid;
    }

    .pasal-title,
    .pasal-subtitle {
        page-break-after: avoid;
        break-after: avoid;
    }

    .paraf-table {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }

    /* =========================================================
       TYPOGRAPHY
    ========================================================= */
    .document-page p {
        display: block;
        width: 100%;
        margin: 0 0 4px 0;
        padding: 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;
        text-align: justify;
        overflow-wrap: break-word;
    }

    .document-page h2 {
        display: block;
        margin: 0 0 6px 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 14pt;
        line-height: 1.2;
        text-align: center;
        font-weight: bold;
    }

    .document-page h3 {
        font-size: 12pt;
        margin: 8px 0 4px 0;
    }

    /* =========================================================
       TITLE / PASAL
    ========================================================= */
    .doc-title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        margin-bottom: 4px;
    }

    .doc-no {
        text-align: center;
        font-size: 12pt;
        margin-bottom: 14px;
    }

    .pasal-title {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        margin-top: 10px;
        margin-bottom: 0;
        line-height: 1.2;
    }

    .pasal-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    /* =========================================================
       INDENT
    ========================================================= */
    .indent {
        margin-left: 0 !important;
        padding-left: 8mm !important;
        text-indent: -8mm !important;
    }

    .indent-2 {
        margin-left: 0 !important;
        padding-left: 16mm !important;
        text-indent: -16mm !important;
    }

    /* =========================================================
       FORMULA
    ========================================================= */
    .formula {
        text-align: center !important;
        font-weight: bold;
        margin-top: 4px !important;
        margin-bottom: 6px !important;
    }

    /* =========================================================
       SIGNATURE
    ========================================================= */
    .signature-wrapper {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 15mm;
        text-align: center;
    }

    .signature-column {
        width: 45%;
        font-size: 12pt;
        line-height: 1.3;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .signature-space {
        height: 20mm;
        width: 100%;
    }

    .signature-space-2 {
        height: 7mm;
        width: 100%;
    }

    .signature-image-wrapper-2 {
        height: 10mm;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2mm;
        position: relative;
        overflow: visible;
    }

    .signature-image-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 22mm;
        padding: 4px;
    }

    .signature-image-10 {
        display: block;
        width: 20mm;
        height: 20mm;
        object-fit: contain;
    }

    .signature-image {
        display: block;
        max-width: 42mm;
        max-height: 8mm;
        object-fit: contain;
        transform: scale(2) translateY(-5mm);
        transform-origin: center center;
        position: relative;
    }

    .signature-image-2 {
        display: block;
        max-width: 42mm;
        max-height: 8mm;
        object-fit: contain;
        transform: scale(2);
        transform-origin: center center;
        position: relative;
        z-index: 5;
    }

    .signature-image-3 {
        display: inline-block;
        width: 20mm;
        height: 20mm;
        object-fit: contain;
        vertical-align: middle;
    }

    .signature-name-2 {
        font-weight: bold;
        text-decoration: underline;
        min-height: 1.2em;
    }

    .signature-name {
        font-weight: bold;
        text-decoration: underline;
        min-height: 1.2em;
        margin-top: -1mm;
    }

    .signature-title {
        min-height: 1.2em;
        font-style: italic;
    }

    /* =========================================================
       PARAF TABLE
    ========================================================= */
    .paraf-table {
        margin-top: auto;
        margin-left: auto;
        margin-right: 0;
        margin-bottom: 0;

        width: 45mm;
        table-layout: fixed;
        height: 18mm;

        border-collapse: collapse;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 10pt;
        line-height: 1.2;

        page-break-inside: avoid;
        break-inside: avoid;
    }

    .paraf-table td {
        border: 1px solid #000;
        text-align: center;
        vertical-align: middle;
        padding: 1mm;
        overflow: hidden;
    }

    .paraf-table tr:first-child td {
        height: 6mm;
    }

    .paraf-table tr:last-child td {
        height: 12mm;
        width: 50%;
    }

    .paraf-table .paraf-title {
        font-weight: bold;
        height: 6mm;
    }

    .paraf-table .paraf-box {
        height: 12mm;
        width: 50%;
        vertical-align: middle;
        text-align: center;
    }

    .paraf-box-hrd {
        text-align: center;
        vertical-align: middle;
        padding: 4px;
    }

    .paraf-table .paraf-box img {
        display: block;
        margin: 0 auto;
        margin-left: -3mm;
        max-width: 140%;
        max-height: 140%;
        width: auto;
        height: auto;
        object-fit: contain;
        transform: scale(1.4);
        transform-origin: center center;
    }

    /* =========================================================
       DATA TABLE
    ========================================================= */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 6px 0 10px 0;
    }

    .data-table td {
        vertical-align: top;
        padding: 1px 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;
    }

    .data-table .data-label {
        width: 32mm;
        white-space: nowrap;
        font-weight: bold;
        padding-right: 2mm;
        vertical-align: top;
    }

    .data-table .data-sep {
        width: 4mm;
        text-align: center;
        vertical-align: top;
    }

    .data-table .data-value {
        vertical-align: top;
    }

    /* =========================================================
       FLOATING SIGN BUTTON
    ========================================================= */
    @keyframes floatPulse {
        0%   { box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45); }
        50%  { box-shadow: 0 8px 36px rgba(0, 158, 247, 0.75); }
        100% { box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45); }
    }

    .floating-sign-btn {
        position: fixed;
        right: 30px;
        bottom: 30px;
        z-index: 1050;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 50px;
        padding: 14px 26px;
        background: #009ef7;
        color: #ffffff;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 13pt;
        font-weight: bold;
        box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45);
        cursor: pointer;
        animation: floatPulse 2.4s ease-in-out infinite;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .floating-sign-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0, 158, 247, 0.65);
        background: #0086d1;
    }

    .floating-sign-btn.is-edit {
        background: #17C653;
        animation: none;
        box-shadow: 0 8px 24px rgba(23, 198, 83, 0.35);
    }

    .floating-sign-btn.is-edit:hover {
        background: #12a344;
        box-shadow: 0 12px 32px rgba(23, 198, 83, 0.55);
    }

    .floating-sign-btn-2 {
        position: fixed;
        bottom: 30px;
        left: 30px;
        z-index: 999;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: #ffffff;
        color: #3f4254;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        border: 1px solid #e4e6ef;
        border-radius: 50px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease, background 0.2s ease, color 0.2s ease;
    }

    .floating-sign-btn-2:hover {
        background: #3699ff;
        color: #ffffff;
        border-color: #3699ff;
        transform: translateX(-4px);
        box-shadow: 0 6px 18px rgba(54, 153, 255, 0.35), 0 2px 6px rgba(54, 153, 255, 0.2);
    }

    .floating-sign-btn-2:active {
        transform: translateX(-2px) scale(0.97);
    }

    .floating-sign-btn-2 i {
        font-size: 1.1rem;
        transition: transform 0.25s ease;
    }

    .floating-sign-btn-2:hover i {
        transform: translateX(3px);
    }

    .floating-sign-btn-2 i.ki-arrow-left {
        transition: transform 0.25s ease;
    }

    .floating-sign-btn-2:hover i.ki-arrow-left {
        transform: translateX(-3px);
    }

    @media (max-width: 576px) {
        .floating-sign-btn-2 {
            bottom: 20px;
            left: 20px;
            padding: 10px 18px;
            font-size: 0.85rem;
        }
    }

    /* =========================================================
       SIGNATURE PAD — FINAL
    ========================================================= */
    .signature-pad-wrapper {
        position: relative;
        width: 100%;
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .signature-pad-canvas {
        display: block;
        width: 100%;
        height: 220px;
        cursor: crosshair;
        touch-action: none;
        background: #ffffff;
        -webkit-user-select: none;
        user-select: none;
    }

    .signature-clear-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid #e4e6ef;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
    }

    .signature-clear-btn:hover {
        background: #fff5f8;
        border-color: #f1416c;
        color: #f1416c;
    }

    /* =====================================================
       MODAL SIGN — BASE
       ===================================================== */

    #kt_modal_sign .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    #kt_modal_sign .modal-dialog {
        margin: 1.5rem auto;
        max-width: 500px;
        width: calc(100% - 2rem);
    }

    #kt_modal_sign .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        align-items: center;
    }

    #kt_modal_sign .modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #181c32;
    }

    #kt_modal_sign .modal-body {
        padding: 24px;
    }

    #kt_modal_sign .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #f1f5f9;
        gap: 8px;
        display: flex;
        justify-content: flex-end;
    }

    /* =====================================================
       MODAL SIGN — RESPONSIVE MOBILE (BOTTOM SHEET)
       ===================================================== */
    @media (max-width: 576px) {

    /* ============ MODAL CONTAINER ============ */
    #kt_modal_sign.modal {
        padding: 0 !important;
        overflow-x: hidden;
    }

    /* ============ MODAL DIALOG ============ */

     #kt_modal_sign .modal-dialog {
        margin-top: auto !important;      /* dorong ke bawah */
        margin-bottom: 500px !important;   /* jarak dari bawah */
        display: flex;
       
    }

    /* ============ MODAL CONTENT ============ */
    #kt_modal_sign .modal-content {
        border-radius: 20px 20px 0 0 !important;
        max-height: 92vh;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    /* ============ HEADER ============ */
    #kt_modal_sign .modal-header {
        padding: 18px 22px 14px;
        flex-shrink: 0;
    }

    #kt_modal_sign .modal-title {
        font-size: 15px;
    }

    /* ============ BODY ============ */
    #kt_modal_sign .modal-body {
        padding: 20px 22px;
        overflow-y: auto;
        flex: 1;
    }

    /* ============ FOOTER ============ */
    #kt_modal_sign .modal-footer {
        padding: 14px 22px 20px;
        flex-direction: column-reverse;
        flex-shrink: 0;
        border-top: 1px solid #f1f5f9;
    }

    #kt_modal_sign .modal-footer .btn {
        width: 100%;
        padding: 12px;
        font-weight: 600;
    }

    /* ============ CANVAS ============ */
    .signature-pad-canvas {
        height: 160px;
    }

    .signature-clear-btn {
        top: 8px;
        right: 8px;
        font-size: 11px;
        padding: 4px 10px;
    }
}   

    /* Tablet */
    @media (min-width: 577px) and (max-width: 768px) {

        #kt_modal_sign .modal-dialog {
            max-width: 480px;
        }
    }

    /* =========================================================
       PRINT — FINAL FIX
       - page-break-after: always untuk semua .document-page
       - :last-of-type → tidak page-break setelah halaman terakhir
       - Whitespace antar .document-page tidak memicu page-break
    ========================================================= */
    @media print {
        @page {
            size: A4 portrait;
            margin: 0 !important;
        }

        html, body {
            width: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
        }

        /* Sembunyikan elemen UI */
        .floating-sign-btn,
        .floating-sign-btn-2,
        .modal,
        .modal-backdrop,
        .progress-stepper-float,
        .progress-stepper-card,
        .app-sidebar,
        .app-header,
        .app-toolbar {
            display: none !important;
        }

        /* Setiap halaman paksa pindah ke halaman berikutnya */
        .document-page {
            width: 210mm !important;
            min-height: 297mm !important;
            height: auto !important;
            margin: 0 !important;
            padding: 15mm !important;
            position: relative;

            page-break-after: always;
            break-after: page;
        }

        /* KUNCI 1: Halaman terakhir TIDAK paksa pindah
           → mencegah halaman kosong di akhir */
        .document-page:last-of-type {
            page-break-after: auto !important;
            break-after: auto !important;
        }

        /* KUNCI 2: Whitespace antar .document-page tidak memicu page-break
           → mencegah halaman kosong di tengah */
        .document-page + .document-page {
            page-break-before: avoid !important;
            break-before: avoid !important;
        }

        /* Konten tidak boleh terpotong */
        .paraf-table {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .document-page p,
        .document-page ol,
        .document-page ul,
        .document-page h3 {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .pasal-title,
        .pasal-subtitle {
            page-break-after: avoid;
            break-after: avoid;
        }

        body,
        body.stepper-collapsed {
            padding-top: 0 !important;
        }
    }
</style>
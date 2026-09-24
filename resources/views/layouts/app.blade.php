<!DOCTYPE html>
<html data-bs-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bukaka - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/bukaka1.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    {{-- ===== CUSTOM DATATABLE CSS (GLOBAL) ===== --}}
    <style>
        /* ============ TABLE HEADER ============ */
        .datatable-custom thead tr {
            background-color: #e7f3ff !important;
            border-bottom: 2px solid #3699ff;
        }

        .datatable-custom thead th {
            color: #1b5e94 !important;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* ============ TABLE BODY ============ */
        .datatable-custom tbody tr {
            background-color: #ffffff;
            transition: background-color 0.15s ease;
        }

        .datatable-custom tbody tr:hover {
            background-color: #f4faff !important;
        }

        .datatable-custom tbody td {
            color: #3f4254;
            font-size: 0.85rem;
            border-bottom: 1px solid #f0f2f5;
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
        }

        .datatable-custom tbody tr.row-selected {
            background-color: #e7f3ff !important;
        }
    </style>

    @yield('style')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="aside-enabled">
    <!--begin::Theme mode setup on page load-->
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
    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="flex-row page d-flex flex-column-fluid">
            <!--begin::Aside-->
            @include('layouts.sidebar')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.header')
                <!--end::Header-->
                <!--begin::Content-->
                @yield('content')
                <!--end::Content-->
                <!--begin::Footer-->
                @include('layouts.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--end::Main-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    @include('layouts.js-file')

    {{-- ===== CUSTOM DATATABLE HELPER (GLOBAL) ===== --}}
    <script>
        /**
         * ============================================================
         * DataTable Helper — Global Utility
         * ============================================================
         * Helper reusable untuk DataTables.
         *
         * Fitur:
         *   - registerDateRangeFilter()  → filter rentang tanggal
         *   - resetDateRangeFilter()     → reset filter rentang tanggal
         *
         * Contoh pakai:
         *   DataTableHelper.registerDateRangeFilter({
         *       table:        table,
         *       startInput:   '#filterStartDate',
         *       endInput:     '#filterEndDate',
         *       columnIndex:  6,
         *       useDataOrder: true
         *   });
         * ============================================================
         */
        (function (window, $) {
            'use strict';

            function registerDateRangeFilter(config) {

                var table        = config.table;
                var startInput   = config.startInput;
                var endInput     = config.endInput;
                var columnIndex  = config.columnIndex;
                var useDataOrder = config.useDataOrder !== false;

                if (!table || !startInput || !endInput || columnIndex === undefined) {
                    console.warn('[DataTableHelper] registerDateRangeFilter: config tidak lengkap.', config);
                    return;
                }

                // Guard: hanya berlaku untuk tabel yang didaftarkan
                $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {

                    if (settings.nTable !== table.table().node()) {
                        return true;
                    }

                    var startVal = $(startInput).val();
                    var endVal   = $(endInput).val();

                    if (!startVal && !endVal) return true;

                    var rawDate;

                    if (useDataOrder) {
                        var rowNode = table.row(dataIndex).node();
                        rawDate = $(rowNode).find('td').eq(columnIndex).data('order');
                    } else {
                        rawDate = data[columnIndex];
                    }

                    if (!rawDate) return false;

                    if (startVal && rawDate < startVal) return false;
                    if (endVal   && rawDate > endVal)   return false;

                    return true;
                });

                $(startInput).on('change', function () { table.draw(); });
                $(endInput).on('change',   function () { table.draw(); });
            }

            function resetDateRangeFilter(table, startInput, endInput) {
                $(startInput).val('');
                $(endInput).val('');
                if (table) table.draw();
            }

            window.DataTableHelper = {
                registerDateRangeFilter: registerDateRangeFilter,
                resetDateRangeFilter:    resetDateRangeFilter,
            };

        })(window, jQuery);
    </script>

    @yield('script')
</body>
<!--end::Body-->

</html>
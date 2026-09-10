<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>403 - Access Denied</title>

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
            background-color: rgba(241, 65, 108, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-icon-wrapper i {
            font-size: 65px;
            color: #f1416c;
        }

        .error-code {
            font-size: 100px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -5px;
            color: #181c32;
        }

        .security-warning {
            background-color: #fff5f8;
            border: 1px dashed #f1416c;
            border-radius: 8px;
        }

        .security-warning-title {
            color: #f1416c;
            font-weight: 700;
        }

        .security-warning-text {
            color: #5e6278;
            font-size: 13px;
            line-height: 1.7;
        }

        .security-footer {
            color: #a1a5b7;
            font-size: 12px;
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

        }

    </style>

</head>


<body>

<div class="error-wrapper d-flex flex-column flex-center">

    <div class="error-card text-center">


        {{-- Security Icon --}}
        <div class="error-icon-wrapper mb-8">

            <i class="ki-duotone ki-shield-cross">

                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>

            </i>

        </div>


        {{-- Error Code --}}
        <div class="error-code mb-5">

            403

        </div>


        {{-- Title --}}
        <h1 class="fw-bolder text-gray-900 mb-4">

            AKSES DITOLAK

        </h1>


        {{-- Description --}}
        <div class="text-gray-600 fs-5 lh-lg mb-8">

            Anda tidak memiliki izin untuk mengakses
            <br>
            halaman atau sumber daya ini.

        </div>


        {{-- Security Warning --}}
        <div class="security-warning text-start p-5 mb-7">

            <div class="d-flex align-items-start">

                <i class="ki-duotone ki-information-5 text-danger fs-2x me-4">

                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>

                </i>


                <div>

                    <div class="security-warning-title mb-2">

                        PERINGATAN KEAMANAN

                    </div>


                    <div class="security-warning-text">

                        Akses terhadap sumber daya ini dibatasi
                        berdasarkan hak akses pengguna.

                        <strong class="text-gray-800">

                            Setiap percobaan akses yang tidak
                            diizinkan dapat dicatat oleh sistem
                            untuk keperluan keamanan dan audit.

                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- Security Footer --}}
        <div class="security-footer mb-7">

            <i class="ki-outline ki-shield-tick me-1"></i>

            Unauthorized access is prohibited.

        </div>


        {{-- Back Button --}}
        <a
            href="{{ url('/') }}"
            class="btn btn-primary px-8">

            <i class="ki-outline ki-arrow-left fs-3 me-2"></i>

            Kembali ke Dashboard

        </a>

    </div>

</div>

</body>

</html>


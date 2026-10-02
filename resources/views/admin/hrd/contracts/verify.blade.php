<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukaka - Verifikasi Contract</title>

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
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1f2937;
        }

        .verify-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .verify-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(30, 108, 180, 0.08);
            overflow: hidden;
            border: 1px solid #e8eef5;
        }

        /* ============ BRAND BAR ============ */
        .verify-brand-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            border-bottom: 2px solid #e8eef5;
            background: #ffffff;
        }

        .verify-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .verify-brand img {
            height: 32px;
            width: auto;
            object-fit: contain;
        }

        .verify-brand-name {
            color: #1e6cb4;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: -0.01em;
        }

        .verify-brand-subtitle {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ============ HEADER ============ */
        .verify-header {
            text-align: center;
            padding: 36px 32px 28px;
            background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
        }

        .verify-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #dbeafe;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        .verify-icon::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px dashed #bfdbfe;
            opacity: 0.6;
        }

        .verify-icon i {
            font-size: 40px;
            color: #1e6cb4;
        }

        .verify-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e6cb4;
            margin: 0 0 8px;
            letter-spacing: -0.01em;
        }

        .verify-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* ============ BODY ============ */
        .verify-body {
            padding: 32px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table td {
            padding: 14px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .info-table td:first-child {
            color: #64748b;
            width: 40%;
            font-weight: 500;
        }

        .info-table td:last-child {
            color: #0f172a;
            font-weight: 600;
        }

        .section-title {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1e6cb4;
            margin: 32px 0 12px;
            padding-left: 10px;
            border-left: 3px solid #1e6cb4;
        }

        /* ============ APPROVAL ITEM ============ */
        .approval-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            background: #f8fbff;
            border: 1px solid #e8eef5;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .approval-item .icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .approval-item .icon i {
            font-size: 18px;
            color: #1e6cb4;
        }

        .approval-item .content {
            flex: 1;
        }

        .approval-item .name {
            font-weight: 600;
            color: #0f172a;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .approval-item .meta {
            font-size: 12px;
            color: #64748b;
        }

        /* ============ FOOTER ============ */
        .verify-footer {
            text-align: center;
            padding: 22px 32px 24px;
            border-top: 1px solid #f1f5f9;
            background: #fafcff;
        }

        .verify-footer .timestamp {
            font-size: 12.5px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .verify-footer .timestamp strong {
            color: #0f172a;
        }

        .verify-footer .branding {
            font-size: 11.5px;
            color: #94a3b8;
        }

        .verify-footer .branding strong {
            color: #1e6cb4;
            font-weight: 600;
        }

        /* ============ HELP TEXT ============ */
        .help-text {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 22px;
            line-height: 1.6;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 600px) {
            .verify-wrapper {
                padding: 20px 12px;
            }

            .verify-brand-bar {
                padding: 14px 20px;
            }

            .verify-brand img {
                height: 26px;
            }

            .verify-brand-name {
                font-size: 15px;
            }

            .verify-brand-subtitle {
                font-size: 10px;
            }

            .verify-header {
                padding: 28px 20px 22px;
            }

            .verify-body {
                padding: 22px 20px;
            }

            .verify-footer {
                padding: 18px 20px;
            }

            .info-table td:first-child {
                width: 45%;
            }
        }
    </style>
</head>
<body>

<div class="verify-wrapper">
    <div class="verify-card">

        {{-- ============ BRAND BAR ============ --}}
        <div class="verify-brand-bar">
            <a href="https://bukakablp.com" target="_blank" class="verify-brand">
                <img src="{{ asset('assets/media/logos/bukaka1.png') }}"
                     alt="Bukaka">
                <span class="verify-brand-name">Bukaka</span>
            </a>

            <span class="verify-brand-subtitle">
                Contract Verification
            </span>
        </div>

        {{-- ============ HEADER ============ --}}
        <div class="verify-header">
            <div class="verify-icon">
                <i class="ki-outline ki-shield-tick"></i>
            </div>

            <h1>Contract Verified</h1>
            <p>Dokumen ini terdaftar dan sah di sistem kami.</p>
        </div>

        {{-- ============ BODY ============ --}}
        <div class="verify-body">

            {{-- Info Contract --}}
            <div class="section-title">Contract Information</div>

            <table class="info-table">
                <tr>
                    <td>Contract Number</td>
                    <td>{{ $contract->contract_number }}</td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>{{ $contract->title }}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>{{ strtoupper($contract->type) }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{ ucfirst($contract->category ?? '-') }}</td>
                </tr>
                <tr>
                    <td>Period</td>
                    <td>
                        {{ optional($contract->start_date)->format('d M Y') }}
                        &mdash;
                        {{ optional($contract->end_date)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @php
                            $statusMap = [
                                'draft'       => ['badge-light-secondary', 'Draft'],
                                'sent'        => ['badge-light-warning',   'Sent'],
                                'viewed'      => ['badge-light-info',      'Viewed'],
                                'signed'      => ['badge-light-info',      'Signed'],
                                'signed-hrd'  => ['badge-light-info',      'Approved HRD'],
                                'signed-head' => ['badge-light-success',   'Complete'],
                                'expired'     => ['badge-light-danger',    'Expired'],
                            ];
                            [$badgeClass, $badgeLabel] = $statusMap[$contract->status]
                                ?? ['badge-light-secondary', ucfirst($contract->status)];
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                    </td>
                </tr>
            </table>

            {{-- Info Employee --}}
            <div class="section-title">Employee Information</div>

            <table class="info-table">
                <tr>
                    <td>Employee Name</td>
                    <td>{{ $contract->employee_name ?? $contract->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Employee Number</td>
                    <td>{{ $contract->user->employee_number ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Project</td>
                    <td>{{ $contract->project->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>{{ $contract->position ?? '-' }}</td>
                </tr>
            </table>

            {{-- Approval History --}}
            <div class="section-title">Approval History</div>

            @if ($contract->employee_signed_at)
                <div class="approval-item">
                    <div class="icon"><i class="ki-outline ki-check"></i></div>
                    <div class="content">
                        <div class="name">Signed by Employee</div>
                        <div class="meta">
                            {{ $contract->employee_name ?? $contract->user->name ?? '-' }}
                            &mdash;
                            {{ $contract->employee_signed_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($contract->hrd_signed_at)
                <div class="approval-item">
                    <div class="icon"><i class="ki-outline ki-check"></i></div>
                    <div class="content">
                        <div class="name">Approved by HRD</div>
                        <div class="meta">
                            @php
                                $hrdUser = $contract->hrd_signature
                                    ? \App\Models\User::find($contract->hrd_signature)
                                    : null;
                            @endphp
                            {{ $hrdUser->name ?? '-' }}
                            &mdash;
                            {{ $contract->hrd_signed_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($contract->head_signed_at)
                <div class="approval-item">
                    <div class="icon"><i class="ki-outline ki-check"></i></div>
                    <div class="content">
                        <div class="name">Approved by Head of Branch</div>
                        <div class="meta">
                            @php
                                $headUser = $contract->head_signature
                                    ? \App\Models\User::find($contract->head_signature)
                                    : null;
                            @endphp
                            {{ $headUser->name ?? '-' }}
                            &mdash;
                            {{ $contract->head_signed_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (
                !$contract->employee_signed_at &&
                !$contract->hrd_signed_at &&
                !$contract->head_signed_at
            )
                <div class="text-muted text-center py-4 fs-7">
                    Belum ada riwayat approval.
                </div>
            @endif

        </div>

        {{-- ============ FOOTER ============ --}}
        <div class="verify-footer">
            <div class="timestamp">
                Halaman ini diverifikasi pada:
                <strong>{{ now()->format('d M Y, H:i:s') }} WIB</strong>
            </div>
            <div class="branding">
                Powered by <strong>Bukaka Balikpapan Brench</strong>
            </div>
        </div>

    </div>

    <div class="help-text">
        Jika Anda memerlukan klarifikasi lebih lanjut, silakan hubungi HRD kami.
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>
</html>
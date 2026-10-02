<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Contract — {{ $contract->contract_number }}</title>

    {{-- Metronic CSS --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f5f8fa;
            min-height: 100vh;
        }

        .verify-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .verify-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .verify-header {
            text-align: center;
            padding: 48px 32px 32px;
            background: linear-gradient(180deg, #f0fdf4 0%, #ffffff 100%);
        }

        .verify-header .verify-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #d1fae5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .verify-header .verify-icon i {
            font-size: 40px;
            color: #059669;
        }

        .verify-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 8px;
        }

        .verify-header p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }

        .verify-body {
            padding: 32px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #f3f4f6;
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
            color: #6b7280;
            width: 40%;
            font-weight: 500;
        }

        .info-table td:last-child {
            color: #111827;
            font-weight: 600;
        }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            margin: 32px 0 12px;
        }

        .approval-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .approval-item .icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .approval-item .icon i {
            font-size: 18px;
            color: #059669;
        }

        .approval-item .content {
            flex: 1;
        }

        .approval-item .name {
            font-weight: 600;
            color: #111827;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .approval-item .meta {
            font-size: 12px;
            color: #6b7280;
        }

        .verify-footer {
            text-align: center;
            padding: 24px 32px 32px;
            border-top: 1px solid #f3f4f6;
            background: #fafbfc;
        }

        .verify-footer .timestamp {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .verify-footer .branding {
            font-size: 12px;
            color: #9ca3af;
        }

        @media (max-width: 600px) {
            .verify-wrapper {
                padding: 20px 12px;
            }

            .verify-header {
                padding: 32px 20px 24px;
            }

            .verify-body {
                padding: 24px 20px;
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

        {{-- Header --}}
        <div class="verify-header">
            <div class="verify-icon">
                <i class="ki-outline ki-shield-tick"></i>
            </div>

            <h1>Contract Verified</h1>
            <p>Dokumen ini terdaftar dan sah di sistem kami.</p>
        </div>

        {{-- Body --}}
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

            {{-- Employee Signed --}}
            @if ($contract->employee_signed_at)
                <div class="approval-item">
                    <div class="icon">
                        <i class="ki-outline ki-check"></i>
                    </div>
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

            {{-- HRD Approved --}}
            @if ($contract->hrd_signed_at)
                <div class="approval-item">
                    <div class="icon">
                        <i class="ki-outline ki-check"></i>
                    </div>
                    <div class="content">
                        <div class="name">Approved by HRD</div>
                        <div class="meta">
                            {{ $contract->hrd_signature ?? '-' }}
                            &mdash;
                            {{ $contract->hrd_signed_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Head Approved --}}
            @if ($contract->head_signed_at)
                <div class="approval-item">
                    <div class="icon">
                        <i class="ki-outline ki-check"></i>
                    </div>
                    <div class="content">
                        <div class="name">Approved by Head of Branch</div>
                        <div class="meta">
                            {{ $contract->head_signature ?? '-' }}
                            &mdash;
                            {{ $contract->head_signed_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Kalau belum ada approval sama sekali --}}
            @if (!$contract->employee_signed_at && !$contract->hrd_signed_at && !$contract->head_signed_at)
                <div class="text-muted text-center py-4 fs-7">
                    Belum ada riwayat approval.
                </div>
            @endif

        </div>

        {{-- Footer --}}
        <div class="verify-footer">
            <div class="timestamp">
                Halaman ini diverifikasi pada:
                <strong>{{ now()->format('d M Y, H:i:s') }} WIB</strong>
            </div>
            <div class="branding">
                Powered by {{ config('app.name') }}
            </div>
        </div>

    </div>

    {{-- Bantuan --}}
    <div class="text-center mt-6 text-muted fs-8">
        Jika Anda memerlukan klarifikasi lebih lanjut,
        silakan hubungi HRD kami.
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>
</html>
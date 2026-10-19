 <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
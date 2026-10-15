{{-- ============================================================= --}}
{{-- ALLOWANCES - UNTUK HALAMAN CREATE & EDIT                     --}}
{{-- Kalau $contract ada → mode edit, kalau tidak → mode create    --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

@if ($type === 'all-in')

    {{-- ========================================================= --}}
    {{-- ALL-IN --}}
    {{-- ========================================================= --}}

    {{-- Tunjangan Projek --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunjangan Projek</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="project_allowance"
                   placeholder="0"
                   value="{{ old('project_allowance', $c->project_allowance ?? null) ? number_format((float) old('project_allowance', $c->project_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="project_allowance" id="project_allowance"
               value="{{ old('project_allowance', $c->project_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-mahal-um-ut-fungsi')

    {{-- ========================================================= --}}
    {{-- gp-mahal-um-ut-fungsi --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-um-ut-fungsi')

    {{-- ========================================================= --}}
    {{-- gp-um-ut-fungsi --}}
    {{-- ========================================================= --}}

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-um-ut')

    {{-- ========================================================= --}}
    {{-- gp-um-ut --}}
    {{-- ========================================================= --}}

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-um-ut-laut')

    {{-- ========================================================= --}}
    {{-- gp-um-ut-laut --}}
    {{-- ========================================================= --}}

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Laut --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Laut</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="sea_allowance"
                   placeholder="0"
                   value="{{ old('sea_allowance', $c->sea_allowance ?? null) ? number_format((float) old('sea_allowance', $c->sea_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja (Laut)</span>
        </div>
        <input type="hidden" name="sea_allowance" id="sea_allowance"
               value="{{ old('sea_allowance', $c->sea_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-mahal-um-ut-fungsi-pls')

    {{-- ========================================================= --}}
    {{-- gp-mahal-um-ut-fungsi-pls --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Pulsa --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Pulsa</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="pulse_allowance"
                   placeholder="0"
                   value="{{ old('pulse_allowance', $c->pulse_allowance ?? null) ? number_format((float) old('pulse_allowance', $c->pulse_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="pulse_allowance" id="pulse_allowance"
               value="{{ old('pulse_allowance', $c->pulse_allowance ?? 0) }}">
    </div>

@elseif ($type === 'gp-mahal-um-ut')

    {{-- ========================================================= --}}
    {{-- gp-mahal-um-ut --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif ($type === 'security')

    {{-- ========================================================= --}}
    {{-- security --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Insentif Khusus Security --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Insentif Khusus Security</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="security_incentive"
                   placeholder="0"
                   value="{{ old('security_incentive', $c->security_incentive ?? null) ? number_format((float) old('security_incentive', $c->security_incentive ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="security_incentive" id="security_incentive"
               value="{{ old('security_incentive', $c->security_incentive ?? 0) }}">
    </div>

    {{-- Shift Malam --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Shift Malam</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="night_shift_allowance"
                   placeholder="0"
                   value="{{ old('night_shift_allowance', $c->night_shift_allowance ?? null) ? number_format((float) old('night_shift_allowance', $c->night_shift_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja Shift Malam</span>
        </div>
        <input type="hidden" name="night_shift_allowance" id="night_shift_allowance"
               value="{{ old('night_shift_allowance', $c->night_shift_allowance ?? 0) }}">
    </div>

@elseif ($type === 'ob')

    {{-- ========================================================= --}}
    {{-- OB --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

@elseif ($type === 'pep-lokal-buny')

    {{-- ========================================================= --}}
    {{-- PROJECT: pep-lokal-buny --}}
    {{-- ========================================================= --}}

    {{-- Tidak ada tunjangan — hanya Gaji Pokok --}}
    <div class="col-12">
        <div class="alert alert-light-primary d-flex align-items-center">
            <i class="ki-duotone ki-information-5 fs-2 me-3 text-primary"></i>
            <span>Tipe ini hanya menggunakan <strong>Gaji Pokok</strong> tanpa tunjangan tambahan.</span>
        </div>
    </div>

@elseif ($type === 'elis-phkt-5-2')

    {{-- ========================================================= --}}
    {{-- PROJECT: elis-phkt-5-2 --}}
    {{-- ========================================================= --}}

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Laut --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Laut</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="sea_allowance"
                   placeholder="0"
                   value="{{ old('sea_allowance', $c->sea_allowance ?? null) ? number_format((float) old('sea_allowance', $c->sea_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja (Laut)</span>
        </div>
        <input type="hidden" name="sea_allowance" id="sea_allowance"
               value="{{ old('sea_allowance', $c->sea_allowance ?? 0) }}">
    </div>

@elseif ($type === 'elis-phkt-6-1')

    {{-- ========================================================= --}}
    {{-- PROJECT: elis-phkt-6-1 --}}
    {{-- ========================================================= --}}

    {{-- Tidak ada tunjangan — hanya Gaji Pokok --}}
    <div class="col-12">
        <div class="alert alert-light-primary d-flex align-items-center">
            <i class="ki-duotone ki-information-5 fs-2 me-3 text-primary"></i>
            <span>Tipe ini hanya menggunakan <strong>Gaji Pokok</strong> tanpa tunjangan tambahan.</span>
        </div>
    </div>

@elseif ($type === 'eni-muara-bakau-lembur')

    {{-- ========================================================= --}}
    {{-- PROJECT: eni-muara-bakau-lembur --}}
    {{-- ========================================================= --}}

    {{-- Uang Kehadiran (Makan & Transport) --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Kehadiran (Makan & Transport)</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="attendance_allowance"
                   placeholder="0"
                   value="{{ old('attendance_allowance', $c->attendance_allowance ?? null) ? number_format((float) old('attendance_allowance', $c->attendance_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="attendance_allowance" id="attendance_allowance"
               value="{{ old('attendance_allowance', $c->attendance_allowance ?? 0) }}">
    </div>

@elseif ($type === 'eni-muara-bakau-all-in')

    {{-- ========================================================= --}}
    {{-- PROJECT: eni-muara-bakau-all-in --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Pulsa --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Pulsa</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="pulse_allowance"
                   placeholder="0"
                   value="{{ old('pulse_allowance', $c->pulse_allowance ?? null) ? number_format((float) old('pulse_allowance', $c->pulse_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="pulse_allowance" id="pulse_allowance"
               value="{{ old('pulse_allowance', $c->pulse_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif ($type === 'ipfms-dobu')

    {{-- ========================================================= --}}
    {{-- PROJECT: ipfms-dobu --}}
    {{-- ========================================================= --}}

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunjangan Laut --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunjangan Laut</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="sea_allowance"
                   placeholder="0"
                   value="{{ old('sea_allowance', $c->sea_allowance ?? null) ? number_format((float) old('sea_allowance', $c->sea_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja (Jika Laut)</span>
        </div>
        <input type="hidden" name="sea_allowance" id="sea_allowance"
               value="{{ old('sea_allowance', $c->sea_allowance ?? 0) }}">
    </div>
{{-- ========================================================= --}}
{{-- NEW PROJECT TYPES — Batch 2026                         --}}
{{-- ========================================================= --}}

@elseif (in_array($type, ['eni-smallcapital-all-in', 'warlok-all-in', 'lawe-lawe-all-in']))

    {{-- ========================================================= --}}
    {{-- GROUP A: Tunj. Jabatan (3 type All In)                 --}}
    {{-- eni-smallcapital-all-in, warlok-all-in, lawe-lawe-all-in --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Jabatan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Jabatan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="position_allowance"
                   placeholder="0"
                   value="{{ old('position_allowance', $c->position_allowance ?? null) ? number_format((float) old('position_allowance', $c->position_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan (All-In)</span>
        </div>
        <input type="hidden" name="position_allowance" id="position_allowance"
               value="{{ old('position_allowance', $c->position_allowance ?? 0) }}">
    </div>

@elseif (in_array($type, ['eni-civil-all-in', 'phss-major-ai-1', 'phss-humas']))

    {{-- ========================================================= --}}
    {{-- GROUP B: Tunj. Fungsional (3 type)                      --}}
    {{-- eni-civil-all-in, phss-major-ai-1, phss-humas          --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif ($type === 'phss-major-ai-2')

    {{-- ========================================================= --}}
    {{-- GROUP C: Fungsional + Makan + Transport                 --}}
    {{-- phss-major-ai-2                                         --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan (All-In)</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan (All-In)</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan (All-In)</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

@elseif ($type === 'eni-civil-reguler')

    {{-- ========================================================= --}}
    {{-- GROUP G: Kemahalan + Makan + Transport + Fungsional     --}}
    {{-- eni-civil-reguler                                       --}}
    {{-- ========================================================= --}}

    {{-- Tunj. Kemahalan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Kemahalan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="cost_allowance"
                   placeholder="0"
                   value="{{ old('cost_allowance', $c->cost_allowance ?? null) ? number_format((float) old('cost_allowance', $c->cost_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="cost_allowance" id="cost_allowance"
               value="{{ old('cost_allowance', $c->cost_allowance ?? 0) }}">
    </div>

    {{-- Uang Makan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Makan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="meal_allowance"
                   placeholder="0"
                   value="{{ old('meal_allowance', $c->meal_allowance ?? null) ? number_format((float) old('meal_allowance', $c->meal_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="meal_allowance" id="meal_allowance"
               value="{{ old('meal_allowance', $c->meal_allowance ?? 0) }}">
    </div>

    {{-- Uang Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- Tunj. Fungsional --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tunj. Fungsional</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="functional_allowance"
                   placeholder="0"
                   value="{{ old('functional_allowance', $c->functional_allowance ?? null) ? number_format((float) old('functional_allowance', $c->functional_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="functional_allowance" id="functional_allowance"
               value="{{ old('functional_allowance', $c->functional_allowance ?? 0) }}">
    </div>

@elseif (in_array($type, ['eni-smallcapital-reguler', 'warlok-lembur', 'phss-driver', 'phss-reguler', 'lawe-lawe-reguler']))

    {{-- ========================================================= --}}
    {{-- GROUP D: Uang Kehadiran (5 type)                        --}}
    {{-- eni-smallcapital-reguler, warlok-lembur, phss-driver,  --}}
    {{-- phss-reguler, lawe-lawe-reguler                        --}}
    {{-- ========================================================= --}}

    {{-- Uang Kehadiran --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Kehadiran (Makan & Transport)</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="attendance_allowance"
                   placeholder="0"
                   value="{{ old('attendance_allowance', $c->attendance_allowance ?? null) ? number_format((float) old('attendance_allowance', $c->attendance_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="attendance_allowance" id="attendance_allowance"
               value="{{ old('attendance_allowance', $c->attendance_allowance ?? 0) }}">
    </div>

@elseif (in_array($type, ['warlok-security', 'phss-security']))

    {{-- ========================================================= --}}
    {{-- GROUP E: Kehadiran + Security Incentive (2 type)       --}}
    {{-- warlok-security, phss-security                         --}}
    {{-- ========================================================= --}}

    {{-- Uang Kehadiran --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Uang Kehadiran (Makan & Transport)</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="attendance_allowance"
                   placeholder="0"
                   value="{{ old('attendance_allowance', $c->attendance_allowance ?? null) ? number_format((float) old('attendance_allowance', $c->attendance_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="attendance_allowance" id="attendance_allowance"
               value="{{ old('attendance_allowance', $c->attendance_allowance ?? 0) }}">
    </div>

    {{-- Insentif Khusus Security --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Insentif Khusus Security</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="security_incentive"
                   placeholder="0"
                   value="{{ old('security_incentive', $c->security_incentive ?? null) ? number_format((float) old('security_incentive', $c->security_incentive ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="security_incentive" id="security_incentive"
               value="{{ old('security_incentive', $c->security_incentive ?? 0) }}">
    </div>

@elseif (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2']))

    {{-- ========================================================= --}}
    {{-- GROUP F: Sand Monitoring (2 type)                       --}}
    {{-- sandmon-teknisi-1, sandmon-teknisi-2                   --}}
    {{-- ========================================================= --}}

    {{-- Housing --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Housing</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="housing_allowance"
                   placeholder="0"
                   value="{{ old('housing_allowance', $c->housing_allowance ?? null) ? number_format((float) old('housing_allowance', $c->housing_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="housing_allowance" id="housing_allowance"
               value="{{ old('housing_allowance', $c->housing_allowance ?? 0) }}">
    </div>

    {{-- Transport --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Transport</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="transport_allowance"
                   placeholder="0"
                   value="{{ old('transport_allowance', $c->transport_allowance ?? null) ? number_format((float) old('transport_allowance', $c->transport_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="transport_allowance" id="transport_allowance"
               value="{{ old('transport_allowance', $c->transport_allowance ?? 0) }}">
    </div>

    {{-- EWHC --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">EWHC (65% dari THP)</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="ewhc_allowance"
                   placeholder="0"
                   value="{{ old('ewhc_allowance', $c->ewhc_allowance ?? null) ? number_format((float) old('ewhc_allowance', $c->ewhc_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="ewhc_allowance" id="ewhc_allowance"
               value="{{ old('ewhc_allowance', $c->ewhc_allowance ?? 0) }}">
    </div>

    {{-- Daily Allowance --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Daily Allowance</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="daily_allowance"
                   placeholder="0"
                   value="{{ old('daily_allowance', $c->daily_allowance ?? null) ? number_format((float) old('daily_allowance', $c->daily_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Hari Masuk Kerja</span>
        </div>
        <input type="hidden" name="daily_allowance" id="daily_allowance"
               value="{{ old('daily_allowance', $c->daily_allowance ?? 0) }}">
    </div>

    {{-- Annual Leave Allowance --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Annual Leave Allowance</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="annual_leave_allowance"
                   placeholder="0"
                   value="{{ old('annual_leave_allowance', $c->annual_leave_allowance ?? null) ? number_format((float) old('annual_leave_allowance', $c->annual_leave_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="annual_leave_allowance" id="annual_leave_allowance"
               value="{{ old('annual_leave_allowance', $c->annual_leave_allowance ?? 0) }}">
    </div>

    {{-- Severance / Complement --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">Complement / Pesangon</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="text"
                   class="form-control currency-input"
                   data-target="severance_allowance"
                   placeholder="0"
                   value="{{ old('severance_allowance', $c->severance_allowance ?? null) ? number_format((float) old('severance_allowance', $c->severance_allowance ?? null), 0, ',', '.') : '' }}"
                   inputmode="numeric"
                   autocomplete="off">
            <span class="input-group-text">/ Bulan</span>
        </div>
        <input type="hidden" name="severance_allowance" id="severance_allowance"
               value="{{ old('severance_allowance', $c->severance_allowance ?? 0) }}">
    </div>

@elseif (in_array($type, ['phss-major-ai-3', 'sched-5-2']))

    {{-- ========================================================= --}}
    {{-- GROUP H & I: Tidak Ada Tunjangan (2 type)               --}}
    {{-- phss-major-ai-3, sched-5-2                             --}}
    {{-- ========================================================= --}}

    <div class="col-12">
        <div class="alert alert-light-primary d-flex align-items-center">
            <i class="ki-duotone ki-information-5 fs-2 me-3 text-primary"></i>
            <span>Tipe ini hanya menggunakan <strong>Gaji Pokok</strong> tanpa tunjangan tambahan.</span>
        </div>
    </div>

@endif
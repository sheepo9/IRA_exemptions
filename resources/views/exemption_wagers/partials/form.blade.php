<div class="mb-3">
    <label>Full Name of Applicant</label>
    <input type="text" name="applicant_name" class="form-control"
           value="{{ old('applicant_name', $exemption_wager->applicant_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Physical Address</label>
    <input type="text" name="physical_address" class="form-control"
           value="{{ old('physical_address', $exemption_wager->physical_address ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Postal Address</label>
    <input type="text" name="postal_address" class="form-control"
           value="{{ old('postal_address', $exemption_wager->postal_address ?? '') }}">
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control"
               value="{{ old('phone', $exemption_wager->phone ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label>Fax</label>
        <input type="text" name="fax" class="form-control"
               value="{{ old('fax', $exemption_wager->fax ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $exemption_wager->email ?? '') }}">
    </div>
</div>
<div class="mb-3">
    <label>Sector/Industry</label>
    <input type="text" name="sector_industry" class="form-control"
           value="{{ old('sector_industry', $exemption_wager->sector_industry ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Wage Order Name & Date</label>
    <input type="text" name="wage_order_name" class="form-control"
           value="{{ old('wage_order_name', $exemption_wager->wage_order_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Detailed Statement</label>
    <textarea name="detailed_statement" rows="4" class="form-control">{{ old('detailed_statement', $exemption_wager->detailed_statement ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Representative/Applicant Name</label>
    <input type="text" name="representative_name" class="form-control"
           value="{{ old('representative_name', $exemption_wager->representative_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Position</label>
    <input type="text" name="position" class="form-control"
           value="{{ old('position', $exemption_wager->position ?? '') }}">
</div>
<div class="mb-3">
    <label>Date</label>
    <input type="date" name="application_date" class="form-control"
           value="{{ old('application_date', $exemption_wager->application_date ?? '') }}" required>
</div>

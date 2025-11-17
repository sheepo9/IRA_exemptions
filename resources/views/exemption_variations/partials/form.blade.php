<div class="mb-3">
    <label>Applicant Name</label>
    <input type="text" name="applicant_name" class="form-control"
        value="{{ old('applicant_name', $exemption_variation->applicant_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control"
        value="{{ old('address', $exemption_variation->address ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Sections from which exemption or variation is sought</label>
    <textarea name="sections_sought" class="form-control" rows="3" required>{{ old('sections_sought', $exemption_variation->sections_sought ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Category or categories of affected employees</label>
    <textarea name="categories_affected" class="form-control" rows="3">{{ old('categories_affected', $exemption_variation->categories_affected ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Representative Name</label>
    <input type="text" name="representative_name" class="form-control"
        value="{{ old('representative_name', $exemption_variation->representative_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Position</label>
    <input type="text" name="position" class="form-control"
        value="{{ old('position', $exemption_variation->position ?? '') }}">
</div>

<div class="mb-3">
    <label>Application Date</label>
    <input type="date" name="application_date" class="form-control"
        value="{{ old('application_date', $exemption_variation->application_date ?? '') }}" required>
</div>

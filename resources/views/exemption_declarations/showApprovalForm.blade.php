@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="mb-3">
    <label>Minister Name</label>
    <input type="text" name="minister_name" class="form-control"
        value="{{ old('minister_name', $exemption_declaration->minister_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Applicant Name</label>
    <input type="text" name="applicant_name" class="form-control"
        value="{{ old('applicant_name', $exemption_declaration->applicant_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Physical Address</label>
    <input type="text" name="physical_address" class="form-control"
        value="{{ old('physical_address', $exemption_declaration->physical_address ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Exemption Sections (1.1 – 1.5)</label>
    <textarea name="exemption_sections" class="form-control" rows="4">{{ old('exemption_sections', $exemption_declaration->exemption_sections ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Variation Sections (2.1 – 2.5)</label>
    <textarea name="variation_sections" class="form-control" rows="4">{{ old('variation_sections', $exemption_declaration->variation_sections ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label>Effective From</label>
        <input type="date" name="effective_from" class="form-control"
            value="{{ old('effective_from', $exemption_declaration->effective_from ?? '') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label>Effective To</label>
        <input type="date" name="effective_to" class="form-control"
            value="{{ old('effective_to', $exemption_declaration->effective_to ?? '') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label>Signed Date</label>
        <input type="date" name="signed_date" class="form-control"
            value="{{ old('signed_date', $exemption_declaration->signed_date ?? '') }}" required>
    </div>
</div>

@endsection
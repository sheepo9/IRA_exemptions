@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Application</h4>
                <a href="{{ route('operations.show', $application->id) }}" class="btn btn-secondary btn-sm">Back to View</a>
            </div>
            <div class="card-body">
                <form action="{{ route('operations.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Employer Information -->
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Employer Information</h5>
                            
                            <div class="mb-3">
                                <label for="employer_name" class="form-label">Employer Name *</label>
                                <input type="text" class="form-control" id="employer_name" name="employer_name" 
                                       value="{{ old('employer_name', $application->employer_name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" 
                                       value="{{ old('registration_number', $application->registration_number) }}">
                            </div>

                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" 
                                       value="{{ old('contact_person', $application->contact_person) }}">
                            </div>

                            <div class="mb-3">
                                <label for="postal_address" class="form-label">Postal Address</label>
                                <input type="text" class="form-control" id="postal_address" name="postal_address" 
                                       value="{{ old('postal_address', $application->postal_address) }}">
                            </div>

                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" 
                                       value="{{ old('telephone', $application->telephone) }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', $application->email) }}">
                            </div>
                        </div>

                        <!-- Business Information -->
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Business Information</h5>
                            
                            <div class="mb-3">
                                <label for="nature_of_business" class="form-label">Nature of Business</label>
                                <textarea class="form-control" id="nature_of_business" name="nature_of_business" 
                                          rows="3">{{ old('nature_of_business', $application->nature_of_business) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="motivation" class="form-label">Motivation for Continuous Operation</label>
                                <textarea class="form-control" id="motivation" name="motivation" 
                                          rows="3">{{ old('motivation', $application->motivation) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="period" class="form-label">Period of Operation</label>
                                <input type="text" class="form-control" id="period" name="period" 
                                       value="{{ old('period', $application->period) }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Shift Information -->
                    <h5 class="border-bottom pb-2 mb-3">Shift Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="employee_categories" class="form-label">Employee Categories</label>
                                <input type="text" class="form-control" id="employee_categories" name="employee_categories" 
                                       value="{{ old('employee_categories', $application->employee_categories) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="number_of_shifts" class="form-label">Number of Shifts</label>
                                <input type="number" class="form-control" id="number_of_shifts" name="number_of_shifts" 
                                       value="{{ old('number_of_shifts', $application->number_of_shifts) }}" min="1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="hours_per_shift" class="form-label">Hours per Shift</label>
                                <input type="number" class="form-control" id="hours_per_shift" name="hours_per_shift" 
                                       value="{{ old('hours_per_shift', $application->hours_per_shift) }}" min="1" max="24">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="off_days" class="form-label">Off Days</label>
                                <input type="text" class="form-control" id="off_days" name="off_days" 
                                       value="{{ old('off_days', $application->off_days) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift_roster" class="form-label">Shift Roster (File Upload)</label>
                                <input type="file" class="form-control" id="shift_roster" name="shift_roster" 
                                       accept=".pdf,.doc,.docx,.xlsx,.xls">
                                <div class="form-text">
                                    @if($application->shift_roster)
                                        Current file: <a href="{{ Storage::disk('public')->url($application->shift_roster) }}" target="_blank">View</a>
                                    @else
                                        No file uploaded
                                    @endif
                                    <br>Accepted formats: PDF, DOC, DOCX, XLSX, XLS (Max: 2MB)
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Signature Section -->
                    <h5 class="border-bottom pb-2 mb-3">Declaration</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="signature" class="form-label">Signature</label>
                                <input type="text" class="form-control" id="signature" name="signature" 
                                       value="{{ old('signature', $application->signature) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_signed" class="form-label">Date Signed</label>
                                <input type="date" class="form-control" id="date_signed" name="date_signed" 
                                       value="{{ old('date_signed', $application->date_signed) }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('operations.show', $application->id) }}" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
@endsection
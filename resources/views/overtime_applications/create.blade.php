@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Sidebar column -->
    <div class="col-md-3">
        @include('layouts.sidebar')
    </div>

    <div class="col-md-9">
        <div class="container mt-4">
            <h2>Submit Overtime Application</h2>

            <form action="{{ route('overtime-applications.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Employer/Company Name</label>
                        <input type="text" name="employer_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Postal Address</label>
                    <input type="text" name="postal_address" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tel No</label>
                        <input type="text" name="tel_no" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Motivation</label>
                    <textarea name="motivation" class="form-control" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Proposed New Overtime Daily Limit</label>
                        <input type="text" name="proposed_daily_limit" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Proposed New Overtime Weekly Limit</label>
                        <input type="text" name="proposed_weekly_limit" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Work on Sundays / Public Holidays?</label>
                    <select name="work_on_sundays" class="form-select">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Class of Employees</label>
                    <textarea name="class_of_employees" class="form-control" rows="2"></textarea>
                </div>

                <!-- ✅ Employee Consent Upload -->
                <div class="mb-3">
                    <label>Employee Consent Document</label>
                    <input type="file" 
                           name="employee_consent_document" 
                           class="form-control"
                           accept=".pdf,.doc,.docx,.jpg,.png">
                </div>

                <div class="mb-3">
                    <label>Period Sought</label>
                    <input type="text" name="period_sought" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Signature Date</label>
                    <input type="date" name="signature_date" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Submit Application</button>
                <a href="{{ route('overtime-applications.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<p class="text-center text-primary">
    <small>&copy; {{ date('Y') }} Ministry of Justice & Labour (MoJLR). All rights reserved.</small>
</p>
@endsection

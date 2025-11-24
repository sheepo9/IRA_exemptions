@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container mt-4">
    <h2>Edit Overtime Application</h2>

    <form action="{{ route('overtime-applications.update', $overtimeApplication->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Employer/Company Name</label>
                <input type="text" name="employer_name" class="form-control" value="{{ $overtimeApplication->employer_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" value="{{ $overtimeApplication->contact_person }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Postal Address</label>
            <input type="text" name="postal_address" class="form-control" value="{{ $overtimeApplication->postal_address }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tel No</label>
                <input type="text" name="tel_no" class="form-control" value="{{ $overtimeApplication->tel_no }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $overtimeApplication->email }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Motivation</label>
            <textarea name="motivation" class="form-control" rows="3">{{ $overtimeApplication->motivation }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Proposed Daily Limit</label>
                <input type="text" name="proposed_daily_limit" class="form-control" value="{{ $overtimeApplication->proposed_daily_limit }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Proposed Weekly Limit</label>
                <input type="text" name="proposed_weekly_limit" class="form-control" value="{{ $overtimeApplication->proposed_weekly_limit }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Work on Sundays / Public Holidays?</label>
            <select name="work_on_sundays" class="form-select">
                <option value="0" {{ !$overtimeApplication->work_on_sundays ? 'selected' : '' }}>No</option>
                <option value="1" {{ $overtimeApplication->work_on_sundays ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Class of Employees</label>
            <textarea name="class_of_employees" class="form-control" rows="2">{{ $overtimeApplication->class_of_employees }}</textarea>
        </div>

        <div class="mb-3">
            <label>Employee Consent Link</label>
            <input type="url" name="employee_consent_link" class="form-control" value="{{ $overtimeApplication->employee_consent_link }}">
        </div>

        <div class="mb-3">
            <label>Period Sought</label>
            <input type="text" name="period_sought" class="form-control" value="{{ $overtimeApplication->period_sought }}">
        </div>

        <div class="mb-3">
            <label>Signature Date</label>
            <input type="date" name="signature_date" class="form-control" value="{{ $overtimeApplication->signature_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('overtime-applications.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
</div>
</div>
<p class="text-center text-primary"><small> &copy; {{ date('Y') }} Ministry of Justice & Labour (MoJLR). All rights reserved.</small></p>

@endsection

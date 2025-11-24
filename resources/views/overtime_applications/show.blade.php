@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Overtime Application Details</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Employer:</strong> {{ $overtimeApplication->employer_name }}</p>
            <p><strong>Contact Person:</strong> {{ $overtimeApplication->contact_person }}</p>
            <p><strong>Postal Address:</strong> {{ $overtimeApplication->postal_address }}</p>
            <p><strong>Tel No:</strong> {{ $overtimeApplication->tel_no }}</p>
            <p><strong>Email:</strong> {{ $overtimeApplication->email }}</p>
            <p><strong>Motivation:</strong> {{ $overtimeApplication->motivation }}</p>
            <p><strong>Proposed Daily Limit:</strong> {{ $overtimeApplication->proposed_daily_limit }}</p>
            <p><strong>Proposed Weekly Limit:</strong> {{ $overtimeApplication->proposed_weekly_limit }}</p>
            <p><strong>Work on Sundays/Public Holidays:</strong> {{ $overtimeApplication->work_on_sundays ? 'Yes' : 'No' }}</p>
            <p><strong>Class of Employees:</strong> {{ $overtimeApplication->class_of_employees }}</p>
            <p><strong>Employee Consent Link:</strong>
                @if($overtimeApplication->employee_consent_link)
                    <a href="{{ $overtimeApplication->employee_consent_link }}" target="_blank">View Consent</a>
                @else
                    N/A
                @endif
            </p>
            <p><strong>Period Sought:</strong> {{ $overtimeApplication->period_sought }}</p>
            <p><strong>Signature Date:</strong> {{ $overtimeApplication->signature_date }}</p>
        </div>
    </div>

    <a href="{{ route('overtime-applications.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
<p class="text-center text-primary"><small> &copy; {{ date('Y') }} Ministry of Justice & Labour (MoJLR). All rights reserved.</small></p>

@endsection

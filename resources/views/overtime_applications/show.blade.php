@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">

    {{-- Header --}}
    <div class="text-center mb-4">
        <h5 class="fw-bold text-uppercase">
            Application to Exceed Overtime Limit
        </h5>
        <p class="mb-0">
            <strong>Labour Act, 2007</strong><br>
            Section 17(4), 21(4) & 22(4)
        </p>
        <hr>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- PARTICULARS OF APPLICANT --}}
            <h6 class="fw-bold text-uppercase border-bottom pb-2 mb-3">
                Particulars of Applicant
            </h6>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Name of Employer / Company:</strong></div>
                <div class="col-md-6">{{ $overtimeApplication->employer_name }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Contact Person:</strong></div>
                <div class="col-md-6">{{ $overtimeApplication->contact_person }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Postal Address:</strong></div>
                <div class="col-md-6">{{ $overtimeApplication->postal_address }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6"><strong>Tel No:</strong></div>
                <div class="col-md-6">{{ $overtimeApplication->tel_no }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6"><strong>Email Address:</strong></div>
                <div class="col-md-6">{{ $overtimeApplication->email }}</div>
            </div>

            {{-- DETAILS OF APPLICATION --}}
            <h6 class="fw-bold text-uppercase border-bottom pb-2 mb-3">
                Details of Application
            </h6>

            <p>
                <strong>Motivation and reasons why the application should be granted:</strong>
            </p>
            <div class="border p-3 mb-3" style="min-height: 100px;">
                {{ $overtimeApplication->motivation }}
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Proposed New Overtime Daily Limit:</strong><br>
                    {{ $overtimeApplication->proposed_daily_limit }}
                </div>
                <div class="col-md-6">
                    <strong>Proposed New Overtime Weekly Limit:</strong><br>
                    {{ $overtimeApplication->proposed_weekly_limit }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Work to be done on Sundays / Public Holidays:</strong>
                <span class="ms-2">
                    {{ $overtimeApplication->work_on_sundays ? 'Yes' : 'No' }}
                </span>
            </div>

            <div class="mb-3">
                <strong>Class of Employees Affected:</strong>
                <div class="border p-2 mt-1">
                    {{ $overtimeApplication->class_of_employees }}
                </div>
            </div>

            {{-- EMPLOYEE CONSENT --}}
            <div class="mb-3">
                <strong>Consent / Agreement of Affected Employees:</strong><br>

                @if($overtimeApplication->hasMedia('employee_consent'))
                    <a href="{{ $overtimeApplication->getFirstMediaUrl('employee_consent') }}"
                       target="_blank"
                       class="btn btn-outline-primary btn-sm mt-2">
                        View Employee Consent Document
                    </a>
                @else
                    <span class="text-muted d-block mt-2">
                        No consent document uploaded
                    </span>
                @endif
            </div>

            <div class="mb-4">
                <strong>Period for which overtime or Sunday/Public Holiday work is sought:</strong>
                <div class="border p-2 mt-1">
                    {{ $overtimeApplication->period_sought }}
                </div>
            </div>

            {{-- SIGNATURE --}}
            <div class="row mt-5">
                <div class="col-md-6">
                    <strong>Signature:</strong>
                    <div class="border-bottom mt-4"></div>
                </div>
                <div class="col-md-6">
                    <strong>Date:</strong><br>
                    {{ $overtimeApplication->signature_date }}
                </div>
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-4">
        <a href="{{ route('overtime-applications.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <p class="text-center text-primary mt-4">
        <small>
            &copy; {{ date('Y') }} Ministry of Justice & Labour Relations (MoJLR).
            All rights reserved.
        </small>
    </p>

</div>
@endsection

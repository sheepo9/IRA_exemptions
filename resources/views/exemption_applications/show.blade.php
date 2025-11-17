@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container mt-4">
    <h3>Exemption Application Details</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Full Name of Applicant:</strong> {{ $exemptionApplication->applicant_name }}</p>
            <p><strong>Physical Address:</strong> {{ $exemptionApplication->physical_address }}</p>
            <p><strong>Postal Address:</strong> {{ $exemptionApplication->postal_address }}</p>
            <p><strong>Phone:</strong> {{ $exemptionApplication->phone }}</p>
            <p><strong>Fax:</strong> {{ $exemptionApplication->fax }}</p>
            <p><strong>Email:</strong> {{ $exemptionApplication->email }}</p>
            <p><strong>Sector / Industry:</strong> {{ $exemptionApplication->sector }}</p>
            <p><strong>Number of Employees:</strong> {{ $exemptionApplication->num_employees }}</p>
            <p><strong>Submitted First Report:</strong> {{ $exemptionApplication->submitted_first_report ? 'Yes' : 'No' }}</p>
            <p><strong>Report Reason (if not submitted):</strong> {{ $exemptionApplication->report_reason }}</p>
            <p><strong>Report Submission Date:</strong> {{ $exemptionApplication->report_date }}</p>
            <p><strong>Supporting Statement:</strong> {{ $exemptionApplication->supporting_statement }}</p>
            <p><strong>Actions Taken:</strong> {{ $exemptionApplication->actions_taken }}</p>
            <p><strong>Representative/Applicant:</strong> {{ $exemptionApplication->representative_name }}</p>
            <p><strong>Position:</strong> {{ $exemptionApplication->position }}</p>
            <p><strong>Date Submitted:</strong> {{ $exemptionApplication->date_submitted }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('exemption-applications.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('exemption-applications.edit', $exemptionApplication->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
</div>
</div>
</div>
@endsection

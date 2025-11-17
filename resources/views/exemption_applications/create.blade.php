@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container mt-4">
    <h3>Application for Exemption to Hold a Valid AA Compliance Certificate</h3>

    <form method="POST" action="{{ route('exemption-applications.store') }}">
        @csrf

        <div class="mb-3">
            <label>Full Name of Applicant</label>
            <input type="text" name="applicant_name" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Physical Address</label>
                <input type="text" name="physical_address" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Postal Address</label>
                <input type="text" name="postal_address" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Fax</label>
                <input type="text" name="fax" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Sector / Industry</label>
                <input type="text" name="sector" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Number of Employees</label>
                <input type="number" name="num_employees" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Has the company submitted its first affirmative action report?</label>
            <select name="submitted_first_report" class="form-select">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>If not yet, why?</label>
            <textarea name="report_reason" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label>If yes, when was the report submitted?</label>
            <input type="date" name="report_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Supporting Statement (reasons for exemption)</label>
            <textarea name="supporting_statement" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Actions taken toward compliance</label>
            <textarea name="actions_taken" class="form-control" rows="3"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Representative/Applicant Name</label>
                <input type="text" name="representative_name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date_submitted" class="form-control">
        </div>

        <button class="btn btn-success" type="submit">Submit Application</button>
        <a href="{{ route('exemption-applications.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
</div>
</div>
@endsection

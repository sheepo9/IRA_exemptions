@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application for Continuous Operation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-5">
      <h4 class="text-center mb-4 text-uppercase fw-bold">
        Application for Continuous Operation <br>
        <small class="text-muted">In Terms of Section 15 (1) of the Labour Act</small>
      </h4>

      {{-- Success Message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('operations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h5 class="mt-4 mb-3 fw-bold">Particulars of Applicant</h5>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Name of Employer/Company</label>
            <input type="text" name="employer_name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Company Registration Number</label>
            <input type="text" name="registration_number" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Contact Person (Mr., Ms., Mrs., Dr., Prof)</label>
            <input type="text" name="contact_person" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Postal Address</label>
            <input type="text" name="postal_address" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Tel No.</label>
            <input type="text" name="telephone" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control">
          </div>
        </div>

        <hr class="my-4">

        <h5 class="fw-bold">Details of Application</h5>

        <div class="mb-3">
          <label class="form-label">Nature of Business Conducted</label>
          <textarea name="nature_of_business" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Motivation and Reasons for Application</label>
          <textarea name="motivation" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Period for which Continuous Operation is Sought</label>
          <input type="text" name="period" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Categories of Employees Affected</label>
          <textarea name="employee_categories" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Proposed Work Schedule</label>
          <p class="text-muted small">(Attach or upload shift roster below)</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">No. of Shifts</label>
              <input type="number" name="number_of_shifts" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">No. of Hours per Shift</label>
              <input type="number" name="hours_per_shift" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Off Days</label>
              <input type="text" name="off_days" class="form-control">
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Upload Shift Roster</label>
          <input type="file" name="shift_roster" class="form-control">
        </div>

        <div class="alert alert-info mt-3">
          If the number of hours per shift exceeds 8 or there is no weekly rest period of at least 36 consecutive hours, please complete an 
          <a href="{{route('exemption-applications.create') }}" class="alert-link">Exemption Form</a>.
        </div>

        <div class="mt-4 text-end">
          <label class="form-label me-3">Signature and Date</label>
          <input type="text" name="signature" class="form-control d-inline-block w-auto" placeholder="Signature">
          <input type="date" name="date_signed" class="form-control d-inline-block w-auto ms-2">
        </div>

        <div class="text-center mt-5">
          <button type="submit" class="btn btn-primary px-4 py-2">Submit Application</button>
        </div>

      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</body>
</html>

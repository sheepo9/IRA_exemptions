@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container">
    <h2>Approve  Exemption Application  for {{ $application->applicant_name }}</h2>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Exemption Application Details</h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th width="30%">Applicant Name</th>
            <td>{{ $application->applicant_name }}</td>
        </tr>

        <tr>
            <th>Physical Address</th>
            <td>{{ $application->physical_address }}</td>
        </tr>

        <tr>
            <th>Postal Address</th>
            <td>{{ $application->postal_address }}</td>
        </tr>

        <tr>
            <th>Phone</th>
            <td>{{ $application->phone }}</td>
        </tr>

        <tr>
            <th>Fax</th>
            <td>{{ $application->fax }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $application->email }}</td>
        </tr>
 </tbody>
</table>
        
    </div>
</div>

    <form action="{{ route('operations.approve', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="approved_document" class="form-label">Upload Approved Document</label>
            <input type="file" name="approved_document" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Approve</button>
    </form>
</div>
</div>
</div>
@endsection
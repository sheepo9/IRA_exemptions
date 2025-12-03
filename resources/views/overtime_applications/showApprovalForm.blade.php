@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container">
    <h2>Approve Application #{{ $application->id }}</h2>

   <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white shadow-sm px-3 py-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Details</li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Details</h5>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Full Name:</div>
                <div class="col-md-9">{{ $application->employer_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Email:</div>
                <div class="col-md-9">{{ $application->email }}</div>
            </div>

           <div class="row mb-3">
                <div class="col-md-3 fw-bold">Contact Person:</div>
                <div class="col-md-9">{{ $application->contact_person }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Telephone</div>
                <div class="col-md-9">{{ $application->tel_no}}</div>
            </div>
            <hr>

            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Date Created:</div>
                <div class="col-md-9">{{ $application->created_at->format('Y-m-d H:i') }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 fw-bold">Last Updated:</div>
                <div class="col-md-9">{{ $application->updated_at->format('Y-m-d H:i') }}</div>
            </div>

            <!-- Action Buttons -->
            

                <form action="{{ route('operations.approve', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="approved_document" class="form-label">Upload Approved Document (optional)</label>
            <input type="file" name="approved_document" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Approve</button>
                      <a href="{{ route('operations.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            
    </form>
           
        </div>
    </div>

</div>
    
</div>
</div>
</div>
<p class="text-center text-primary"><small> &copy; {{ date('Y') }} Ministry of Justice & Labour (MoJLR). All rights reserved.</small></p>

@endsection
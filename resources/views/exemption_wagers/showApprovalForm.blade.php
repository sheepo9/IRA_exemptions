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

    <p>{{ $application->email }} ,
    {{ $application->status}}</td></p>

    <form action="{{ route('Wager_Applications.approve', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="approved_document" class="form-label">Upload Approved Document (optional)</label>
            <input type="file" name="approved_document" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Approve</button>
    </form>
</div>
</div>
</div>
@endsection
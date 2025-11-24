@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
   <div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light text-center">
    <i class="fas fa-lock fa-5x text-danger mb-4 animate__animated animate__shakeX"></i>
    <h1 class="display-4 fw-bold text-danger"> Access Denied </h1>
    <p class="lead text-muted">Sorry, you don’t have permission to access this page OR to complete this action.</p>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary mt-3">
        <i class="fas fa-arrow-left me-2"></i> Go Back
    </a>
</div>
@endsection
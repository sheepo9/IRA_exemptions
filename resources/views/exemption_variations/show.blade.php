@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container">
    <h2>Application Details</h2>
    <div class="card p-4">
        <p><strong>Applicant Name:</strong> {{ $exemption_variation->applicant_name }}</p>
        <p><strong>Address:</strong> {{ $exemption_variation->address }}</p>
        <p><strong>Sections Sought:</strong> {{ $exemption_variation->sections_sought }}</p>
        <p><strong>Categories Affected:</strong> {{ $exemption_variation->categories_affected }}</p>
        <p><strong>Representative:</strong> {{ $exemption_variation->representative_name }}</p>
        <p><strong>Position:</strong> {{ $exemption_variation->position }}</p>
        <p><strong>Application Date:</strong> {{ $exemption_variation->application_date }}</p>
    </div>
    <a href="{{ route('exemption_variations.edit', $exemption_variation->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('exemption_variations.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
</div>
</div>
</div>
@endsection

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
    <h2>Declaration Details</h2>
    <div class="card p-4">
        <p><strong>Minister:</strong> {{ $exemption_declaration->minister_name }}</p>
        <p><strong>Applicant:</strong> {{ $exemption_declaration->applicant_name }}</p>
        <p><strong>Physical Address:</strong> {{ $exemption_declaration->physical_address }}</p>
        <p><strong>Exemption Sections:</strong><br>{{ $exemption_declaration->exemption_sections }}</p>
        <p><strong>Variation Sections:</strong><br>{{ $exemption_declaration->variation_sections }}</p>
        <p><strong>Effective From:</strong> {{ $exemption_declaration->effective_from }}</p>
        <p><strong>Effective To:</strong> {{ $exemption_declaration->effective_to }}</p>
        <p><strong>Signed Date:</strong> {{ $exemption_declaration->signed_date }}</p>
    </div>
    <a href="{{ route('exemption_declarations.edit', $exemption_declaration->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('exemption_declarations.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
</div>
</div>
</div>
@endsection

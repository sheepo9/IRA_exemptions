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
        <p><strong>Applicant Name:</strong> {{ $exemption_wager->applicant_name }}</p>
        <p><strong>Physical Address:</strong> {{ $exemption_wager->physical_address }}</p>
        <p><strong>Postal Address:</strong> {{ $exemption_wager->postal_address }}</p>
        <p><strong>Phone:</strong> {{ $exemption_wager->phone }}</p>
        <p><strong>Fax:</strong> {{ $exemption_wager->fax }}</p>
        <p><strong>Email:</strong> {{ $exemption_wager->email }}</p>
        <p><strong>Sector/Industry:</strong> {{ $exemption_wager->sector_industry }}</p>
        <p><strong>Wage Order:</strong> {{ $exemption_wager->wage_order_name }}</p>
        <p><strong>Detailed Statement:</strong> {{ $exemption_wager->detailed_statement }}</p>
        <p><strong>Representative:</strong> {{ $exemption_wager->representative_name }}</p>
        <p><strong>Position:</strong> {{ $exemption_wager->position }}</p>
        <p><strong>Date:</strong> {{ $exemption_wager->application_date }}</p>
    </div>
    <a href="{{ route('exemption_wagers.edit', $exemption_wager->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('exemption_wagers.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
</div>
</div>
</div>
@endsection

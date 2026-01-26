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
    <h2 class="mb-3">Form LM 34 - Exemption/Variation Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exemption_variations.create') }}" class="btn btn-primary mb-3">New Application</a>
<a href="{{ route('exemption_variations.reviewed') }}" class="btn btn-primary mb-3">View Reviewed Application </a>
<a href="{{ route('exemption_variations.completed') }}" class="btn btn-primary mb-3">View Completed Declarations</a>
<a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">   Back</a>
@foreach(auth()->user()->unreadNotifications as $notification)
    <div class="alert alert-info">
        <strong>{{ $notification->data['message'] }}</strong><br>
        Applicant: {{ $notification->data['applicant_name'] }}<br>
        <a href="{{ $notification->data['url'] }}">View Application</a>
    </div>
@endforeach

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Address</th>
                <th>Representative</th>
                <th>Date</th>
                <th>Status</th>                  
                <th>Actions</th>
                 <th> User Comments</th>
                           
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
                <tr>
                    <td>{{ $app->applicant_name }}</td>
                    <td>{{ $app->address }}</td>
                    <td>{{ $app->representative_name }}</td>
                    <td>{{ $app->application_date }}</td>
                    <td>{{ $app->status }}</td>
                    
                    <td>
                        <a href="{{ route('exemption_variations.show', $app->id) }}" class="btn btn-info btn-sm">Review</a>
                    </td>
                    <td> @if(!empty($app->reviewer_comments))
        <div class="text-muted">
            {{ $app->reviewer_comments }}
        </div>
    @else
        <div class="text-muted fst-italic">
            No comment yet
        </div>
    @endif </td>

            @empty
                <tr><td colspan="5" class="text-center">No applications found.</td>
            
            </tr>
            @endforelse
        </tbody>
    </table>
<a href="{{ url()->previous() }}" class="btn btn-secondary">
    Back
</a>


</div>
</div>
</div>
</div>
@endsection

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
    <h2 class="mb-3">DECLARATION OF EXEMPTION OR VARIATION FROM CHAPTER 3 APPLICATIONS</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exemption_variations.create') }}" class="btn btn-primary mb-3">View Pending Declariontions</a>
<a href="{{ route('exemption_variations.create') }}" class="btn btn-primary mb-3">>View Completed Declariontions</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Address</th>
                <th>Representative</th>
                <th>Date</th>
                <th>Status</th>
                <th>Declare</th>
                                 
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
                  <td><a href="{{ route('Exemption_Variations.approve', $app->id) }}" 
                                           class="btn btn-warning">Declare</a>
                                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No applications found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $applications->links() }}
</div>
</div>
</div>
</div>
@endsection

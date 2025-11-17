@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container mt-4">
    <h3>Exemption Applications</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exemption-applications.create') }}" class="btn btn-primary mb-3">+ New Application</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Applicant</th>
                <th>Email</th>
                
                             <th>Status</th>
                           
                            <th>Actions</th>
                            <th>Download</th>
                             @role('Administrator')
                                        <th>Approve</th>
                                    @endrole
                        </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
            <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->applicant_name }}</td>
                <td>{{ $app->email }}</td>
                <td>{{ $application->status ?? 'N/A' }}</td>
                               <td>
                    <a href="{{ route('exemption-applications.show', $app->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('exemption-applications.edit', $app->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('exemption-applications.destroy', $app->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')">Delete</button>
                    </form>
                </td>
                <td>
                                @if(Auth::user()->hasRole('Administrator'))
                                    {{-- Admin downloads the original application PDF --}}
                                    <a href="{{ route('Exemption_Applications.pdf', $app->id) }}" class="btn btn-primary">
                                        Download Application PDF
                                    </a>
                                @else
                                    {{-- Normal user downloads the approved document --}}
                                    @if($app->approved_document)
                                        <a href="{{ route('Exemption_Applications.download', $app->id) }}" 
                                        class="btn btn-outline-primary">
                                            Download Approved Document
                                        </a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                @endif
                                            @role('Administrator')                                                                          
                                <td>
                                    <a href="{{ route('Exemption_Applications.approve', $app->id) }}" 
                                           class="btn btn-warning">Approve</a>
                                    </td>@endrole
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">No applications found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $applications->links() }}
</div>
</div>
</div>
</div>
@endsection

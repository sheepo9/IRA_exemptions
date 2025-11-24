@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="container mt-4">
    <h2 class="mb-3">Overtime Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('overtime-applications.create') }}" class="btn btn-primary mb-3">+ New Application</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Employer</th>
                <th>Contact Person</th>
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
                <td>{{ $app->employer_name }}</td>
                <td>{{ $app->contact_person }}</td>
                 <td>{{ $app->status }}</td>
                <td>
                    <a href="{{ route('overtime-applications.show', $app->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('overtime-applications.edit', $app->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('overtime-applications.destroy', $app->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')">Delete</button>
                    </form>
                </td>
                <td>
                     @if(Auth::user()->hasRole('Administrator'))
                                    {{-- Admin downloads the original application PDF --}}
                                    <a href="{{ route('Overtime_Applications.pdf', $app->id) }}" class="btn btn-primary">
                                        Download Application PDF
                                    </a>
                                @else
                                    {{-- Normal user downloads the approved document --}}
                                    @if($app->approved_document)
                                        <a href="{{ route('Overtime_Applications.download', $app->id) }}" 
                                        class="btn btn-outline-primary">
                                            Download Approved Document
                                        </a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                @endif
                                            @role('Administrator')                                                                          
                                <td>
                                    <a href="{{ route('Overtime_Applications.approve', $app->id) }}" 
                                           class="btn btn-warning">Approve</a>
                                    </td>@endrole
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No applications found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $applications->links() }}
</div>
</div>
</div>
<p class="text-center text-primary"><small> &copy; {{ date('Y') }} Ministry of Justice & Labour (MoJLR). All rights reserved.</small></p>

@endsection

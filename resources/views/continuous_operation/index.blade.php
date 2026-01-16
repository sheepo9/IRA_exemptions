@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Continuous Operation Applications</h2>
    <a href="{{ route('operations.create') }}" class="btn btn-primary">New Application</a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Application Status</h4>
    </div>

    <div class="card-body">
        @if($applications->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                    <thead>
                        <tr>
                            <th>Employer Name</th>
                            <th>Registration Number</th>
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
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->employer_name }}</td>
                                <td>{{ $application->registration_number ?? 'N/A' }}</td>
                                <td>{{ $application->contact_person ?? 'N/A' }}</td>
                                <td>{{ $application->status ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('operations.edit', $application->id) }}"
                                           class="btn btn-warning">Edit</a>
                                        <form action="{{ route('operations.destroy', $application->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this application?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                @if(Auth::user()->hasRole('Administrator'))
                                    {{-- Admin downloads the original application PDF --}}
                                    <a href="{{ route('operations.pdf', $application->id) }}" class="btn btn-primary">
                                        Download Application PDF
                                    </a>
                                @else
                                    {{-- Normal user downloads the approved document --}}
                                    @if($application->approved_document)
                                        <a href="{{ route('operations.download', $application->id) }}"
                                        class="btn btn-outline-primary">
                                            Download Approved Document
                                        </a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                @endif
                                            @role('Administrator')
                                <td>
                                    <a href="{{ route('operations.show', $application->id) }}"
                                           class="btn btn-info">View</a>
                                    </td>@endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $applications->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <h4>No applications found</h4>
                <p class="text-muted">You haven't submitted any continuous operation applications yet.</p>
                <a href="{{ route('operations.create') }}" class="btn btn-primary">Create Your First Application</a>
            </div>
        @endif
    </div>
</div>
  </div>
    </div>
      </div>
@endsection

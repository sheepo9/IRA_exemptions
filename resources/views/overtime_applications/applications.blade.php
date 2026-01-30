@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Overtime Applications</h4>
    </div>

    {{-- Role-based action buttons --}}
    <div class="mb-4">

        @role('Administrator')
            <a href="{{ route('overtime-applications.applications', ['status' => 'rejected_by_staff']) }}"
               class="btn btn-primary me-2">
                Rejected by Staff
            </a>

            <a href="{{ route('overtime-applications.applications', ['status' => 'approved_by_ed']) }}"
               class="btn btn-success me-2">
                Approved by ED
            </a>
        @endrole

        @role('Deputy_Director')
            <a href="{{ route('overtime-applications.applications', ['status' => 'reviewed_by_staff']) }}"
               class="btn btn-warning me-2">
                Pending Applications
            </a>
        @endrole

        @role('Executive_Director')
            <a href="{{ route('overtime-applications.applications', ['status' => 'rejected_by_ded']) }}"
               class="btn btn-danger me-2">
                Rejected Applications
            </a>
        @endrole

    </div>

    {{-- Applications Table --}}
    <div class="card shadow-sm">
        <div class="card-body">

            @if($applications->isEmpty())
                <div class="alert alert-info mb-0">
                    No overtime applications found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Status</th>
                                <th>Submitted On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $app->employer_name ?? 'N/A' }}</td>
                                    <td>{{ $app->contact_person?? '-' }}</td>
                                    <td>{{ $app->email ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucwords(str_replace('_', ' ', $app->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $app->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('overtime-applications.show', $app->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection

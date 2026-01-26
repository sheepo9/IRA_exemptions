@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <div class="container mt-4">

                <div class="card shadow-sm p-4">

                    <h4 class="mb-4 fw-bold">
                        Reviewed / Approved Applications
                    </h4>

                    @if($applications->isEmpty())
                        <div class="alert alert-info">
                            No reviewed applications found.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Applicant Name</th>
                                        <th>Address</th>
                                        <th>Application Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $index => $application)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $application->applicant_name }}</td>
                                            <td>{{ $application->address }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    Approved
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('exemption_variations.show', $application->id) }}"
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
    </div>
</div>
@endsection

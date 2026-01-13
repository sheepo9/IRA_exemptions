@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
 <div class="col-md-9">

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Application Details</h4>
                <div class="btn-group">
                    <a href="{{ route('operations.edit', $application->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('operations.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Employer Information -->
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3">Employer Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Employer Name:</th>
                                <td>{{ $application->employer_name }}</td>
                            </tr>
                            <tr>
                                <th>Registration Number:</th>
                                <td>{{ $application->registration_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Contact Person:</th>
                                <td>{{ $application->contact_person ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Postal Address:</th>
                                <td>{{ $application->postal_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Telephone:</th>
                                <td>{{ $application->telephone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $application->email ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Business Information -->
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3">Business Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Nature of Business:</th>
                                <td>{{ $application->nature_of_business ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Period:</th>
                                <td>{{ $application->period ?? 'N/A' }}</td>
                            </tr>
                        </table>

                        <h5 class="border-bottom pb-2 mb-3 mt-4">Shift Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Employee Categories:</th>
                                <td>{{ $application->employee_categories ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Number of Shifts:</th>
                                <td>{{ $application->number_of_shifts ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Hours per Shift:</th>
                                <td>{{ $application->hours_per_shift ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Off Days:</th>
                                <td>{{ $application->off_days ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Shift Roster:</th>
                                <td>
            

@if($application->hasMedia('shift_rosters'))
    <a href="{{ route('operations.shiftRoster.preview', $application->id) }}"
       target="_blank"
       class="btn btn-sm btn-info">
        Preview PDF
    </a>

    <a href="{{ route('operations.shiftRoster.download', $application->id) }}"
       class="btn btn-sm btn-primary">
        Download
    </a>
@endif



                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Motivation -->
                @if($application->motivation)
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">Motivation</h5>
                        <p>{{ $application->motivation }}</p>
                    </div>
                </div>
                @endif

                <!-- Signature Section -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3">Declaration</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Signature:</th>
                                <td>{{ $application->signature ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date Signed:</th>
                                <td>{{ $application->date_signed ? \Carbon\Carbon::parse($application->date_signed)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
               <!-- Timestamps -->
                <div class="row mt-4">
                    <div class="col-12">
                        <small class="text-muted">
                            Created: {{ $application->created_at->format('M d, Y H:i') }} | 
                            Last Updated: {{ $application->updated_at->format('M d, Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>


       <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Application status</h4>
               
            </div>

            <div class="card-body">
                    @if($applications->count() > 0)
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>Approved Document</th>
                                    @role('Administrator')
                                        <th>Action</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $app)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $application->email }}</td>
                                        <td>{{ $application->period }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->status == 'Approved' ? 'success' : ($application->status == 'Rejected' ? 'danger' : 'warning') }}">
                                                {{ $app->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($app->approved_document)
                                                <a href="{{ route('operations.download', $application->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    Download
                                                </a>
                                            @else
                                                <span class="text-muted">Not available</span>
                                            @endif
                                        </td>

                                        @role('Administrator')
                                            <td>
                                                @if($application->status !== 'Approved')
                                                    <form action="{{ route('operations.approve', $application->id) }}" 
                                                          method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                                                        @csrf
                                                        <input type="file" name="approved_document" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                @else
                                                    <span class="text-success fw-bold">Approved</span>
                                                @endif
                                            </td>
                                        @endrole
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-3">
                            {{ $applications->links() }}
                        </div>
                    @else
                        <p class="text-center text-muted mb-0">No pending applications found.</p>
                    @endif
                </div>
            </div>
        </div>
          <!--  <tbody>
    <tr>
        <td>{{ $application->email }}</td>
        <td>{{ $application->period }}</td>
        <td>
            <span class="badge bg-{{ $application->status == 'Approved' ? 'success' : 'warning' }}">
                {{ $application->status }}
            </span>
        </td>
        <td>
            @if($application->approved_document)
                <a href="{{ route('operations.download', $application->id) }}" class="btn btn-sm btn-primary">
                    Download
                </a>
            @else
                <span class="text-muted">Not available</span>
            @endif
        </td>
        @role('Administrator')
            <td>
                @if($application->status !== 'Approved')
                    <form action="{{ route('operations.approve', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="approved_document" class="form-control mb-2" accept=".pdf,.doc,.docx">
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>
                @else
                    <span class="text-success">Approved</span>
                @endif
            </td>
        @endrole
    </tr>
</tbody>-->


</div>
</div>
</div>
</div>
</div>
@endsection
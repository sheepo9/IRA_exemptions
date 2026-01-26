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

                <hr class="my-4">

@role('Administrator')
    <h5>Approval</h5>

    @if($application->status !== 'Approved')
        <form action="{{ route('operations.approve', $application->id) }}"
              method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf

            <div class="mb-2">
                <label class="form-label">Upload Approved Document</label>
                <input type="file"
                       name="approved_document"
                       class="form-control"
                       accept=".pdf,.doc,.docx"
                       required>
            </div>

            <button class="btn btn-success">
                Approve Application
            </button>
        </form>
    @else
        <span class="badge bg-success">Application Approved</span>
    @endif
@endrole
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





@role('Staff')
<hr>
<h5>Staff Member Comment</h5>

<form action="{{ route('operations.staff.comment', $application->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <textarea
            name="staff_member_comment"
            class="form-control"
            rows="4"
            placeholder="Enter your comment"
            required
        >{{ old('staff_member_comment', $application->staff_member_comment) }}</textarea>
    </div>

    <button class="btn btn-primary">
        Save Comment
    </button>
</form>
@if($application->staff_member_comment)
    <div class="border rounded p-3 mt-3">
        <strong>Staff Comment</strong>
        <p class="mb-0 mt-2">{{ $application->staff_member_comment }}</p>
    </div>
@endif
@endrole




{{-- Existing comments --}}
<hr class="my-4">

<h4>Comments</h4>


@if(
    $application->staff_member_comment ||
    $application->dd_comment ||
    $application->ded_comment ||
    $application->ed_comment ||
    $application->minister_comment
)

    @if($application->staff_member_comment)
        <div class="border rounded p-3 mb-3">
            <strong>Staff Member</strong>
            <p class="mb-0 mt-2">{{ $application->staff_member_comment }}</p>
        </div>
    @endif

    @if($application->dd_comment)
        <div class="border rounded p-3 mb-3">
            <strong>Deputy Director (DD)</strong>
            <p class="mb-0 mt-2">{{ $application->dd_comment }}</p>
        </div>
    @endif

    @if($application->ded_comment)
        <div class="border rounded p-3 mb-3">
            <strong>Deputy Executive Director (DED)</strong>
            <p class="mb-0 mt-2">{{ $application->ded_comment }}</p>
        </div>
    @endif

    @if($application->ed_comment)
        <div class="border rounded p-3 mb-3">
            <strong>Executive Director (ED)</strong>
            <p class="mb-0 mt-2">{{ $application->ed_comment }}</p>
        </div>
    @endif

    @if($application->minister_comment)
        <div class="border rounded p-3 mb-3">
            <strong>Minister</strong>
            <p class="mb-0 mt-2">{{ $application->minister_comment }}</p>
        </div>
    @endif

@else
    <p class="text-muted">No comments added yet.</p>
@endif



</div>
                </div>



                              <tr>

                                    @role('Administrator')

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
                            @if($applications->count() > 0)
    <table class="table table-hover table-bordered align-middle">
        {{-- table head + body --}}
    </table>

                    @endif
                </div>
            </div>
        </div>



</div>
</div>
</div>
</div>
</div>
@endsection

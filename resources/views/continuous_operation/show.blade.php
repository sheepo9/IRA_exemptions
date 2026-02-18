@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('layouts.sidebar')
    </div>

    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-body">

                <!-- FORM TITLE -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-uppercase">
                        Application for Continuous Operation
                    </h4>
                    <p class="mb-0">
                        In terms of Section 15 (1) of the Labour Act
                    </p>
                </div>

                <hr>

                <!-- PARTICULARS OF APPLICANT -->
                <h5 class="fw-bold text-decoration-underline mb-3">
                    Particulars of Applicant
                </h5>

                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Name of Employer / Company</th>
                        <td>{{ $application->employer_name }}</td>
                    </tr>
                    <tr>
                        <th>Company Registration Number</th>
                        <td>{{ $application->registration_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Contact Person</th>
                        <td>{{ $application->contact_person ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Postal Address</th>
                        <td>{{ $application->postal_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Telephone Number</th>
                        <td>{{ $application->telephone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>{{ $application->email ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- DETAILS OF APPLICATION -->
                <h5 class="fw-bold text-decoration-underline mt-4 mb-3">
                    Details of Application
                </h5>

                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Nature of Business Conducted</th>
                        <td>{{ $application->nature_of_business ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Motivation and Reasons</th>
                        <td style="min-height:120px;">
                            {{ $application->motivation ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Period for which Continuous Operation is Sought</th>
                        <td>{{ $application->period ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Categories of Employees Affected</th>
                        <td>{{ $application->employee_categories ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- PROPOSED WORK SCHEDULE -->
                <h5 class="fw-bold text-decoration-underline mt-4 mb-3">
                    Proposed Work Schedule
                </h5>

                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Number of Shifts</th>
                        <td>{{ $application->number_of_shifts ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Number of Hours per Shift</th>
                        <td>{{ $application->hours_per_shift ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Off Days</th>
                        <td>{{ $application->off_days ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Shift Roster</th>
                        <td>
                            @if($application->hasMedia('shift_rosters'))
                                <a href="{{ route('operations.shiftRoster.preview', $application->id) }}"
                                   class="btn btn-sm btn-info" target="_blank">
                                    Preview
                                </a>
                                <a href="{{ route('operations.shiftRoster.download', $application->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">Not uploaded</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- EXEMPTION NOTICE -->
                <div class="alert alert-warning mt-4">
                    <strong>Note:</strong><br>
                    If the number of hours per shift exceeds 8 hours or no weekly rest
                    period of at least 36 consecutive hours is provided, an exemption
                    must be applied for in terms of Sections 15(2) and 20(2) of the Labour Act.
                </div>

                <!-- DECLARATION -->
                <h5 class="fw-bold text-decoration-underline mt-4 mb-3">
                    Declaration
                </h5>

                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Signature</th>
                        <td>{{ $application->signature ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Date Signed</th>
                        <td>
                            {{ $application->date_signed 
                                ? \Carbon\Carbon::parse($application->date_signed)->format('d M Y') 
                                : 'N/A' }}
                        </td>
                    </tr>
                </table>

@hasanyrole('Administrator|Deputy_Director|Deputy_Executive_Director|Executive_Director|Minister')
<hr class="my-4">
<h6 class="fw-bold text-uppercase border-bottom pb-2 mb-3">
    Internal Review & Comments
</h6>

<form action="{{ route('operations.review', $application->id) }}" method="POST"  enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @role('Administrator')
        <div class="mb-3">
            <label class="fw-bold">Staff Comment</label>
            <textarea name="staff_comment" class="form-control" rows="3" placeholder="Enter staff comment">{{ old('staff_comment', $application->staff_comment) }}</textarea>
        </div>
        <div class="text-end mt-2">
            <button type="submit" name="action" value="staff_approve" class="btn btn-success">Approve & Forward to DD</button>
            <button type="submit" name="action" value="staff_reject" class="btn btn-danger">Reject</button>
        </div>
    @endrole

    @role('Deputy_Director')
        <div class="mb-3">
            <label class="fw-bold">DD Comment</label>
            <textarea name="dd_comment" class="form-control" rows="3" placeholder="Enter DD comment">{{ old('dd_comment', $application->dd_comment) }}</textarea>
        </div>
        <div class="text-end mt-2">
            <button type="submit" name="action" value="dd_approve" class="btn btn-success">Approve & Forward to DED</button>
            <button type="submit" name="action" value="dd_reject" class="btn btn-danger">Reject</button>
        </div>
    @endrole

   @role('Deputy_Executive_Director')
        <div class="mb-3">
            <label class="fw-bold">DED Comment</label>
            <textarea name="ded_comment" class="form-control" rows="3" placeholder="Enter DED comment">{{ old('ded_comment', $application->ded_comment) }}</textarea>
        </div>
         <!-- File upload -->
  
        <div class="text-end mt-2">
            <button type="submit" name="action" value="ded_approve" class="btn btn-success">Approve & Forward to ED</button>
            <button type="submit" name="action" value="ded_reject" class="btn btn-danger">Reject</button>
        </div>
   @endrole
    @role('Executive_Director')
        <div class="mb-3">
            <label class="fw-bold">ED Comment</label>
            <textarea name="ed_comment" class="form-control" rows="3" placeholder="Enter ED comment">{{ old('ed_comment', $application->ed_comment) }}</textarea>
        </div>
         <!-- File upload -->
  
        <div class="text-end mt-2">
            <button type="submit" name="action" value="ed_approve" class="btn btn-success">Approve & Forward to ED</button>
            <button type="submit" name="action" value="ed_reject" class="btn btn-danger">Reject</button>
        </div>
   @endrole

    @role('Minister')
        <div class="mb-3">
            <label class="fw-bold">Minister Comment</label>
            <textarea name="minister_comment" class="form-control" rows="3" placeholder="Enter comment">{{ old('minister_comment', $application->minister_comment) }}</textarea>
        </div>
          <div class="mb-3">
        <label class="fw-bold">Upload Approved Document

        </label>
        <input type="file" name="ed_file" class="form-control">
        @if($application->getFirstMediaUrl('minister_files'))
            <small>Current file: <a href="{{ $application>getFirstMediaUrl('minister_files') }}" target="_blank">View</a></small>
        @endif
    </div>
        <div class="text-end mt-2">
            <button type="submit" name="action" value="minister_approve" class="btn btn-success">Approve (Final)</button>
            <button type="submit" name="action" value="minister_reject" class="btn btn-danger">Reject (Final)</button>
        </div>
  @endrole
</form>
@endhasanyrole



    {{-- Footer --}}
    <div class="text-center mt-4">
        <a href="{{ route('overtime-applications.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
   <!-- FOOTER -->
                <div class="text-muted small mt-4 text-center">
                    Created: {{ $application->created_at->format('d M Y H:i') }} |
                    Last Updated: {{ $application->updated_at->format('d M Y H:i') }}
                </div>
    <p class="text-center text-primary mt-4">
        <small>
            &copy; {{ date('Y') }} Ministry of Justice & Labour Relations (MoJLR).
            All rights reserved.
        </small>
    </p>

</div>


             

            </div>
        </div>
    </div>
</div>
@endsection
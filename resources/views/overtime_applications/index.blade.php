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

 @role('Administrator')
            <a href="{{ route('overtime-applications.applications', ['status' => 'rejected_by_staff']) }}"
               class="btn btn-primary mb-3">
                Rejected by Staff
            </a>

            <a href="{{ route('overtime-applications.applications', ['status' => 'approved_by_ed']) }}"
               class="btn btn-success mb-3">
                Approved by ED
            </a>
        @endrole

        @role('Deputy_Director')
            <a href="{{ route('overtime-applications.applications', ['status' => 'reviewed_by_staff']) }}"
               class="btn btn-warning mb-3">
                Pending Applications
            </a>
        @endrole

        @role('Executive_Director')
            <a href="{{ route('overtime-applications.applications', ['status' => 'approved_by_ed']) }}"
               class="btn btn-danger mb-3">
                Rejected Applications
            </a>
             <a href="{{ route('overtime-applications.applications', ['user_status' => 'pending']) }}"
               class="btn btn-info mb-3i">
                Pending Applications
            </a>
        @endrole
    <table class="table table-bordered table-striped">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Employer</th>
                <th>Contact Person</th>
                @role('User') <th>Status</th>
                @endrole
                 @role('Administrator|Deputy_Director|Deputy_Executive_Director')
                   <th>Internal Status</th>
                 @endrole
                 @role('User|Administrator|Deputy_Director|Deputy_Executive_Director')
                 <th>Comment </th>   
                 @endrole
                                     @role('User')
                                       <th>Actions</th>
                                       <th>Download</th> 

                                    @endrole
                        
                             @role('Administrator|Deputy_Director|Deputy_Executive_Director|Executive_Director')
                                        <th>Review</th>
                                    @endrole
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
            <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->employer_name }}</td>
                <td>{{ $app->contact_person }}</td>
                @role('User') 
                 <td>{{ $app->user_status }}</td>
             @endrole
                    @role('Administrator|Deputy_Director|Deputy_Executive_Director')
                    <td>{{ $app->status }}</td>
                    @endrole
                 <td>
                    @role('User')
                    @if(!empty($app->staff_comment))
                        <div class="text-muted">
                            {{ $app->staff_comment}}
                        </div>
                     @else
                            <div class="text-muted fst-italic">
                                No comment yet
                            </div>
                        @endif
                    @endrole
                     @role('Administrator')
                    @if(!empty($app->staff_comment))
                        <div class="text-muted">
                            {{ $app->DD_comment}}
                        </div>
                     @else
                            <div class="text-muted fst-italic">
                                No comment yet
                            </div>
                        @endif
                    @endrole
                     @role('Deputy_Director')
                    @if(!empty($app->staff_comment))
                        <div class="text-muted">
                            {{ $app->DED_comment }}
                        </div>
                     @else
                            <div class="text-muted fst-italic">
                                No comment yet
                            </div>
                        @endif
                    @endrole
                     @role('Deputy_Executive_Director')
                    @if(!empty($app->staff_comment))
                        <div class="text-muted">
                            {{ $app->ED_comment }}
                        </div>
                     @else
                            <div class="text-muted fst-italic">
                                No comment yet
                            </div>
                        @endif
                    @endrole
                     
  </td>
                                @role('User')
                                <td>
                                    <a href="{{ route('overtime-applications.show', $app->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('overtime-applications.edit', $app->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('overtime-applications.destroy', $app->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')">Delete</button>
                                    </form>
                                </td> @endrole
                                    @role('User') <td>
                                   <div class="mb-3">
  
    <!-- Display DED file links if exists -->
    @if( $app->getFirstMediaUrl('ed_files'))
        <div class="mb-1">
          
            <a href="{{ route('overtime-applications.ded-download',  $app->id) }}" target="_blank">
                Download
            </a> | 
            <a href="{{ route('overtime-applications.ded-preview',  $app->id) }}" target="_blank">
                Preview
            </a>
        </div>
    @else
        <span class="text-muted">No approved document attached yet.</span>
    @endif


                               @endrole </td>

                                 
                                    <td>
                                @role('Deputy_Director')
                                    @if($app->status === 'rejected_by_ded' || $app->status === 'reviewed_by_staff')
                                        <a href="{{ route('overtime-applications.show', $app->id) }}" class="btn btn-warning btn-sm">
                                            Review
                                        </a>
                                    @endif
                                @endrole
                                   
                                     
                                    @role('Deputy_Executive_Director')
                                        @if($app->status === 'approved_by_dd'|| $app->status === 'rejected_by_ed')
                                            <a href="{{ route('overtime-applications.show', $app->id) }}" class="btn btn-warning btn-sm">
                                                Review
                                            </a>
                                        @endif
                                    @endrole
                                        
                                    @role('Executive_Director')
                                        @if($app->status === 'approved_by_ded')
                                            <a href="{{ route('overtime-applications.show', $app->id) }}" class="btn btn-warning btn-sm">
                                                Review
                                            </a>
                                        @endif
                                    @endrole 
                             
                                            @role('Administrator')                                                                          
                               
                                    <a href="{{  route('overtime-applications.show', $app->id) }}" 
                                           class="btn btn-warning">Review</a>
                                    @endrole
                                </td>
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

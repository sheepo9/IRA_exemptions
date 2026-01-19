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
    <h2 class="mb-3">Form LM 34 - Exemption/Variation Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exemption_variations.create') }}" class="btn btn-primary mb-3">New Application</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Address</th>
                <th>Representative</th>
                <th>Date</th>
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
                    <td>{{ $app->applicant_name }}</td>
                    <td>{{ $app->address }}</td>
                    <td>{{ $app->representative_name }}</td>
                    <td>{{ $app->application_date }}</td>
                    <td>{{ $app->status }}</td>
                    <td>
                        <a href="{{ route('exemption_variations.show', $app->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('exemption_variations.edit', $app->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('exemption_variations.destroy', $app->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this record?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                      <td>
                                @if(Auth::user()->hasRole('Administrator'))
                                    {{-- Admin downloads the original application PDF --}}
                                    <a href="{{ route('Exemption_Variations.pdf', $app->id) }}" class="btn btn-primary">
                                        Download Application PDF
                                    </a>
                                @else
                                    {{-- Normal user downloads the approved document --}}
                                    @if($app->approved_document)
                                        <a href="{{ route('Exemption_Variations.download', $app->id) }}" 
                                        class="btn btn-outline-primary">
                                            Download Approved Document
                                        </a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                @endif
                                            @role('Administrator')                                                                          
                                <td>
                                    <a href="{{ route('Exemption_Variations.approve', $app->id) }}" 
                                           class="btn btn-warning">Approve</a>
                                    </td>@endrole
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

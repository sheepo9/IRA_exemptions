@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <!-- Main content column -->
        <div class="col-md-8">
            <h2>Form LM 35 – Declarations of Exemption or Variation</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('exemption_declarations.create') }}" class="btn btn-primary mb-3">New Declaration</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Minister</th>
                        <th>Applicant</th>
                        <th>Effective From</th>
                        <th>Effective To</th>
                         <th>Status</th>
                           
                            <th>Actions</th>
                            <th>Download</th>
                             @role('Administrator')
                                        <th>Approve</th>
                                    @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse($declarations as $item)
                        <tr>
                            <td>{{ $item->minister_name }}</td>
                            <td>{{ $item->applicant_name }}</td>
                            <td>{{ $item->effective_from }}</td>
                            <td>{{ $item->effective_to }}</td>
                            <td>{{ $item-> status}}</td>
                            <td>
                                <a href="{{ route('exemption_declarations.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('exemption_declarations.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('exemption_declarations.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Delete this record?')" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                             <td>
                                @if(Auth::user()->hasRole('Administrator'))
                                    {{-- Admin downloads the original application PDF --}}
                                    <a href="{{ route('Exemption_Declarations.pdf', $item->id) }}" class="btn btn-primary">
                                        Download Application PDF
                                    </a>
                                @else
                                    {{-- Normal user downloads the approved document --}}
                                    @if($item->approved_document)
                                        <a href="{{ route('Exemption_Declarations.download', $item->id) }}" 
                                        class="btn btn-outline-primary">
                                            Download Approved Document
                                        </a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                @endif
                                            @role('Administrator')                                                                          
                                <td>
                                    <a href="{{ route('Exemption_Declarations.approve', $item->id) }}" 
                                           class="btn btn-warning">Approve</a>
                                    </td>@endrole
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{ $declarations->links() }}
        </div>
    </div>
</div>
@endsection
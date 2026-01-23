@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-9">
            <h2 class="mb-3">Completed Declarations</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Address</th>
                        <th>Representative</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr>
                            <td>{{ $app->applicant_name }}</td>
                            <td>{{ $app->address }}</td>
                            <td>{{ $app->representative_name }}</td>
                            <td>{{ $app->application_date }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('exemption_variations.show', $app->id) }}"
                                   class="btn btn-primary btn-sm">
                                    View Declaration
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No completed declarations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('exemption_variations.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>
</div>
@endsection

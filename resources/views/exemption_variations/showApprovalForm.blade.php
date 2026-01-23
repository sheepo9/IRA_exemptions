@extends('layouts.app')

@section('content')
 <div class="row">
        <!-- Sidebar column -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
  <div class="col-md-9">
<div class="container">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-5">
  <div class="card shadow-sm">
    <div class="card-body">

        <!-- Header -->
        <div class="text-center mb-4">
            <h5 class="fw-bold">REPUBLIC OF NAMIBIA</h5>
            <h6 class="fw-bold">LABOUR ACT, 2007</h6>
            <p class="mb-1">(Section 139(2)) (Regulation 26(2))</p>
            <h5 class="fw-bold text-uppercase">
                Declaration of Exemption or Variation from Chapter 3
            </h5>
        </div>

        <form method="POST" action="">
            @csrf

               <p>
            I, <span class="border-bottom d-inline-block px-3">
                Hon. Example Minister
            </span>,
            acting in my capacity of Minister of Labour and Social Welfare, hereby
        </p>

        <p>
            <strong>1.</strong> Exempt (full name of the Applicant(s)):
            <span class="border-bottom d-inline-block px-3">
              {{$application->applicant_name}}
            </span>
            located at (physical address):
            <span class="border-bottom d-inline-block px-3">
                {{$application->address}}
            </span>
            from compliance with the Sections of Chapter 3, Basic Conditions of Employment,
            set forth below in respect of the following categories of employees and subject
            to the following conditions, if any:
        </p>

        <div class="ms-1">
            
            <p>
            <span class="d-inline-block w-75 ps-0">
                @if($application->sections->isNotEmpty())
                    <ol class="mb-0">
                        @foreach($application->sections as $section)
                            <li>{{ $section->name }}</li>
                        @endforeach
                    </ol>
                @else
                    N/A
                @endif
            </span>

            </p>
                   </div>

        <p class="mt-3">
            <strong>2.</strong> Vary the sections of Chapter 3, Basic Conditions of Employment
            as set forth below, in respect of the following categories of employees and
            subject to the following conditions, if any:
        </p>

        <div class="ms-4">
            <p><span class="border-bottom d-inline-block w-75">{{ $application->categories_affected}}</span></p>
           
        </div>

        <p class="mt-3">
            <strong>3.</strong> This exemption or variation is effective from
            <span class="border-bottom d-inline-block px-3"><input type="date" name="effective_from" class="form-control"
            value="{{ old('effective_from', $application->effective_from ?? '') }}" required></span>
            to
            <span class="border-bottom d-inline-block px-3"> <input type="date" name="effective_from" class="form-control"
            value="{{ old('effective_from', $application->effective_from ?? '') }}" required></span>.
        </p>

           <div class="mt-5">
            <p>
                (signed) <span class="border-bottom d-inline-block px-5">Hon. Example Minister</span>
            </p>
            <p>
                <strong>Minister of Justice and Labour Relations</strong>
            </p>
            <p>
                Date: <span class="border-bottom d-inline-block px-4">{{ now()->format('d F Y') }}
            </p>
        </div>

        </div>
</div>
<hr>
@if($application->status !== 'approved')
    <form action="{{ route('exemption_variations.approve', $application->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to approve this application?');">
        @csrf
        <button type="submit" class="btn btn-success mb-3">
            Approve Application
        </button>
    </form>
@endif
<hr>
@if($application->status === 'Reviewed')
<div class="card mt-4">
    <div class="card-header fw-bold">
        Minister Decision
    </div>

    <div class="card-body">
        <form action="{{ route('exemption_variations.minister', $application->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Minister Comments</label>
                <textarea name="minister_comments"
                          class="form-control"
                          rows="4"
                          required>{{ old('minister_comments') }}</textarea>
            </div>

           

            <button class="btn btn-success">
               Add comment
            </button>
        </form>
    </div>
</div>
@endif

<a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">   Back</a>
</div>
</div></div></div></div>
@endsection
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
                Example Company (Pty) Ltd
            </span>
            located at (physical address):
            <span class="border-bottom d-inline-block px-3">
                123 Independence Avenue, Windhoek
            </span>
            from compliance with the Sections of Chapter 3, Basic Conditions of Employment,
            set forth below in respect of the following categories of employees and subject
            to the following conditions, if any:
        </p>

        <div class="ms-4">
            
            <p>1.1 <span class="border-bottom d-inline-block w-75">@if($application->sections->isNotEmpty())
            {{ $application->sections->pluck('name')->join(', ') }}
        @else
            N/A
        @endif</span></p>
            <p>1.2 <span class="border-bottom d-inline-block w-75">Section 21 – Overtime</span></p>
            <p>1.3 <span class="border-bottom d-inline-block w-75">Section 22 – Night Work</span></p>
            <p>1.4 <span class="border-bottom d-inline-block w-75">Section 23 – Leave Entitlement</span></p>
            <p>1.5 <span class="border-bottom d-inline-block w-75">Special conditions as approved</span></p>
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
</span>
            </p>
        </div>

        </div>
</div>

</div>
</div></div></div></div>
@endsection
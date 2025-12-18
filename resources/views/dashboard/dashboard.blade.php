@extends('layouts.app')

@section('content')
<h1 class="fw-bold mb-4">Dashboard</h1>

<div class="row g-4">

    {{-- Applications --}}
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Applications</h5>
                <h2 class="fw-bold">{{ $counts['application'] }}</h2>
            </div>
        </div>
    </div>

    {{-- Exemptions Applications --}}
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Exemptions Applications</h5>
                <h2 class="fw-bold">{{ $counts['exemptionsApplications'] }}</h2>
            </div>
        </div>
    </div>

    {{-- Declarations --}}
    <div class="col-md-4">
        <div class="card text-white bg-warning shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Declarations</h5>
                <h2 class="fw-bold">{{ $counts['declarations'] }}</h2>
            </div>
        </div>
    </div>

    {{-- Variations --}}
    <div class="col-md-2">
        <div class="card text-white bg-danger shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Variations</h5>
                <h2 class="fw-bold">{{ $counts['variations'] }}</h2>
            </div>
        </div>
    </div>

    {{-- Wagers --}}
    <div class="col-md-2">
        <div class="card text-white bg-info shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Wagers</h5>
                <h2 class="fw-bold">{{ $counts['wagers'] }}</h2>
            </div>
        </div>
    </div>

    {{-- Users --}}
    <div class="col-md-2">
        <div class="card text-white bg-dark shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <h2 class="fw-bold">{{ $counts['users'] }}</h2>
            </div>
        </div>
    </div>

</div>
@endsection
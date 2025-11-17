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
    <h2>Submit New Exemption Application</h2>
    <form method="POST" action="{{ route('exemption_wagers.store') }}">
        @csrf
        @include('exemption_wagers.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
</div>
@endsection

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
    <h2>New Application (Form LM 34)</h2>
    <form action="{{ route('exemption_variations.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @include('exemption_variations.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">   Back</a>
    </form>
</div>
</div>
</div>
</div>

@endsection

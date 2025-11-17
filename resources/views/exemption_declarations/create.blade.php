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
    <h2>New Declaration (Form LM 35)</h2>
    <form action="{{ route('exemption_declarations.store') }}" method="POST">
        @csrf
        @include('exemption_declarations.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
</div>
@endsection

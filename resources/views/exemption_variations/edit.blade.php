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
    <h2>Edit Application</h2>
    <form action="{{ route('exemption_variations.update', $exemption_variation->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('exemption_variations.partials.form', ['exemption_variation' => $exemption_variation])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</div>
</div>
</div>
@endsection

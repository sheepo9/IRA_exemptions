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
    <h2>Edit Declaration</h2>
    <form action="{{ route('exemption_declarations.update', $exemption_declaration->id) }}" method="POST">
        @csrf @method('PUT')
        @include('exemption_declarations.partials.form', ['exemption_declaration' => $exemption_declaration])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</div>
</div>
</div>
@endsection

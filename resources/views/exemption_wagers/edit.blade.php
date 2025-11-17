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
    <form method="POST" action="{{ route('exemption_wagers.update', $exemption_wager->id) }}">
        @csrf
        @method('PUT')
        @include('exemption_wagers.partials.form', ['exemption_wager' => $exemption_wager])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</div>
</div>
</div>
@endsection

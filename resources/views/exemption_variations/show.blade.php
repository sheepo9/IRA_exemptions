@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="container mt-4">

                <div class="card shadow-lg p-5" style="font-family: 'Times New Roman', serif;">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h5 class="fw-bold">REPUBLIC OF NAMIBIA</h5>
                        <h6 class="fw-bold">LABOUR ACT, 2007</h6>
                        <p class="mb-1">(Section 139) (Regulation 26(1))</p>
                        <h5 class="fw-bold text-uppercase mt-3">
                            Application for Exemption or Variation from Chapter 3
                        </h5>
                    </div>

                    <hr>

                    <!-- Instructions -->
                    <p class="mb-4">
                        <strong>Instruction:</strong>
                        Attach hereto a detailed statement supporting the proposed exemption(s)
                        or variation(s) of one or more of the Basic Conditions of Employment.
                    </p>

                    <!-- Form Fields -->
                    <div class="mb-3">
                        <p>
                            <strong>1. Name of Applicant:</strong><br>
                            <span class="border-bottom d-inline-block w-100">
                                {{ $exemption_variation->applicant_name }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p>
                            <strong>2. Address:</strong><br>
                            <span class="border-bottom d-inline-block w-100">
                                {{ $exemption_variation->address }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p>
                            <strong>3. Sections of the Labour Act, 2007, from which exemption or variation is sought:</strong><br>
                            <span class="border-bottom d-inline-block w-100">
                                @if($exemption_variation->sections->isNotEmpty())
                                    {{ $exemption_variation->sections->pluck('name')->join(', ') }}
                                @else
                                    N/A
                                @endif
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p>
                            <strong>4. Category or categories of employees affected:</strong><br>
                            <span class="border-bottom d-inline-block w-100">
                                {{ $exemption_variation->categories_affected ?? 'N/A' }}
                            </span>
                        </p>
                    </div>

                    <br><br>

                    <!-- Signature Section -->
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <p class="border-top pt-2">
                                <strong>Representative of Applicant</strong><br>
                                {{ $exemption_variation->representative_name }}
                            </p>
                        </div>

                        <div class="col-md-3">
                            <p class="border-top pt-2">
                                <strong>Position</strong><br>
                                {{ $exemption_variation->position ?? '—' }}
                            </p>
                        </div>

                        <div class="col-md-3">
                            <p class="border-top pt-2">
                                <strong>Date</strong><br>
                                {{ \Carbon\Carbon::parse($exemption_variation->application_date)->format('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Document Section -->
                    <hr class="my-4">

                    <div>
                        <strong>Supporting Document:</strong><br>

                        @if($exemption_variation->hasMedia('submission_document'))
                            <a href="{{ route('submission.preview', $exemption_variation->id) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-info me-2">
                                Preview PDF
                            </a>

                            <a href="{{ route('submission.download', $exemption_variation->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                Download
                            </a>
                        @else
                            <span class="text-muted">No document uploaded.</span>
                        @endif
                    </div>


<div class="card mt-4">
    <div class="card-header fw-bold">
        Reviewer Comments
    </div>

    <div class="card-body">
        <form action="{{ route('exemption_variations.comment', $exemption_variation->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Comments</label>
                <textarea name="reviewer_comments"
                          class="form-control"
                          rows="4"
                          required>{{ old('reviewer_comments', $exemption_variation->reviewer_comments) }}</textarea>
            </div>

           
            <button class="btn btn-primary">
              Comment
            </button>
        </form>
    </div>
</div>











                </div>
<hr class="my-4">

<div class="d-flex d-flex justify-content-end gap-2">


    <!-- Approve Button -->
    @if($exemption_variation->status !== 'approved')
        <form action="{{ route('exemption_variations.approve', $exemption_variation->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to approve this application?');">
            @csrf
            <button type="submit" class="btn btn-success px-4">
                Review Application
            </button>
        </form>
    @endif 
     <a href="{{ route('exemption_variations.index') }}"
                       class="btn btn-secondary px-4">
                        Back
                    </a>
</div>


            </div>
        </div>
    </div>
</div>
@endsection

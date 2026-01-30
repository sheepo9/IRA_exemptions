<div class="card shadow-sm">
    <div class="card-body">

        <!-- Header -->
        <div class="text-center mb-4">
            <h5 class="fw-bold">REPUBLIC OF NAMIBIA</h5>
            <h6 class="fw-bold">LABOUR ACT, 2007</h6>
            <p class="mb-1">(Section 139) (Regulation 26(1))</p>
            <h5 class="fw-bold text-uppercase mt-3">
                Application for Exemption or Variation from Chapter 3
            </h5>
            <p class="fw-semibold">Form LM 34</p>
        </div>

        <!-- Instructions -->
        <div class="alert alert-secondary">
            <strong>Instruction:</strong><br>
            Attach a detailed statement supporting the proposed exemption(s) or variation(s)
            of one or more of the Basic Conditions of Employment, including:
            <ol class="mb-0 mt-2">
                <li>Sections or subsections for which exemption is sought and the reasons;</li>
                <li>Sections or subsections proposed for variation, the proposed language, and reasons;</li>
                <li>Specification of employees or categories of employees affected;</li>
                <li>Written submission on behalf of affected employees, or evidence of consultation with employees.</li>
            </ol>
        </div>

        <!-- Applicant Name -->
        <div class="mb-3">
            <label>Applicant Name</label>
            <input type="text" name="applicant_name" class="form-control"
                value="{{ old('applicant_name', $exemption_variation->applicant_name ?? '') }}" required>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control"
                value="{{ old('address', $exemption_variation->address ?? '') }}" required>
        </div>

        <!-- Sections (Pivot) -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Sections from which exemption or variation is sought</label>

            <div class="row">
                @foreach ($sections as $section)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="sections[]"
                                value="{{ $section->id }}"
                                id="section_{{ $section->id }}"
                                {{ in_array(
                                    $section->id,
                                    old(
                                        'sections',
                                        isset($exemption_variation)
                                            ? $exemption_variation->sections->pluck('id')->toArray()
                                            : []
                                    )
                                ) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="section_{{ $section->id }}">
                                {{ $section->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Categories affected -->
        <div class="mb-3">
            <label>Category or categories of affected employees</label>
            <textarea name="categories_affected" class="form-control" rows="3">{{ old('categories_affected', $exemption_variation->categories_affected ?? '') }}</textarea>
        </div>

        <!-- Representative Name -->
        <div class="mb-3">
            <label>Representative Name</label>
            <input type="text" name="representative_name" class="form-control"
                value="{{ old('representative_name', $exemption_variation->representative_name ?? '') }}" required>
        </div>

        <!-- Position -->
        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control"
                value="{{ old('position', $exemption_variation->position ?? '') }}">
        </div>

        <!-- Application Date -->
        <div class="mb-3">
            <label>Application Date</label>
            <input type="date" name="application_date" class="form-control"
    value="{{ old('application_date', $exemption_variation->application_date?->format('Y-m-d')) }}" required>
  </div>
<div class="mb-3">
    <label>Upload Submission (PDF or DOC)</label>
    <input type="file" name="submission_document" class="form-control" accept=".pdf,.doc,.docx">
    @if(isset($exemption_variation) && $exemption_variation->getFirstMediaUrl('submission_document'))
        <small class="text-muted">

            Current file:  
              <a href="{{ route('submission.preview', $exemption_variation->id) }}"
       target="_blank"  > View</a>
        </small>
    @endif


</div>

    </div>
</div>

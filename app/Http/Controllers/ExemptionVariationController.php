<?php

namespace App\Http\Controllers;

use App\Models\ExemptionVariation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Section;
class ExemptionVariationController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:exemption-variation-list|exemption-variation-create|exemption-variation-edit|exemption-variation-delete', ['only' => ['index','store']]);
    $this->middleware('permission:exemption-variation-create', ['only' => ['create','store']]);
    $this->middleware('permission:exemption-variation-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:exemption-variation-delete', ['only' => ['destroy']]);
}

    public function index()
    {
        $applications = ExemptionVariation::latest()->paginate(10);
        return view('exemption_variations.index', compact('applications'));
    }

    public function create()
    {   $sections = Section::orderBy('name')->get();
    $exemption_variation = new ExemptionVariation();
    return view('exemption_variations.create', compact('sections', 'exemption_variation'));
 }
    public function store(Request $request)
{
    $validated = $request->validate([
        'applicant_name'       => 'required|string|max:255',
        'address'              => 'required|string',
        'categories_affected'  => 'nullable|string',
        'representative_name'  => 'required|string|max:255',
        'position'             => 'nullable|string|max:255',
        'application_date'     => 'required|date',
        'sections'             => 'required|array|min:1',
        'sections.*'           => 'exists:sections,id',
        'submission_document'  => 'nullable|file|mimes:pdf,doc,docx|max:5120',
    ]);

    /** 🔑 REMOVE sections & file before create */
    $data = collect($validated)->except(['sections', 'submission_document'])->toArray();

    /** ✅ Create model FIRST */
    $exemptionVariation = ExemptionVariation::create($data);

    /** ✅ Attach pivot */
    $exemptionVariation->sections()->attach($validated['sections']);

    /** ✅ Attach media AFTER model exists */
    if ($request->hasFile('submission_document')) {
        $exemptionVariation
            ->addMediaFromRequest('submission_document')
            ->toMediaCollection('submission_document');
    }

    return redirect()
        ->route('exemption_variations.index')
        ->with('success', 'Application submitted successfully!');
}

    public function show(ExemptionVariation  $exemption_variation)
    {
        $sections = Section::orderBy('name')->get();
        return view('exemption_variations.show', compact('sections', 'exemption_variation'));
    }

    public function edit(ExemptionVariation $exemption_variation)
    {
       $sections = Section::orderBy('name')->get();

       return view('exemption_variations.edit', compact('sections', 'exemption_variation'));

    }

  public function update(Request $request, ExemptionVariation $exemption_variation)
{
    $validated = $request->validate([
        'applicant_name'        => 'required|string|max:255',
        'address'               => 'required|string',
        'categories_affected'   => 'nullable|string',
        'representative_name'   => 'required|string|max:255',
        'position'              => 'nullable|string|max:255',
        'application_date'      => 'required|date',

        'sections'              => 'required|array|min:1',
        'sections.*'            => 'exists:sections,id',

        'submission_document'   => 'nullable|file|mimes:pdf,doc,docx',
    ]);

    /*
     |------------------------------------------
     | Remove file before mass assignment
     |------------------------------------------
     */
    unset($validated['submission_document'], $validated['sections']);

    /*
     |------------------------------------------
     | Update main model
     |------------------------------------------
     */
    $exemption_variation->update($validated);

    /*
     |------------------------------------------
     | Sync pivot table
     |------------------------------------------
     */
    $exemption_variation->sections()->sync($request->sections);

    /*
     |------------------------------------------
     | Handle Spatie Media upload
     |------------------------------------------
     */
    if ($request->hasFile('submission_document')) {

        // Remove old document if only one is allowed
        $exemption_variation->clearMediaCollection('submission_document');

        $exemption_variation
            ->addMediaFromRequest('submission_document')
            ->toMediaCollection('submission_document');
    }

    return redirect()
        ->route('exemption_variations.index')
        ->with('success', 'Application updated successfully!');
}


    public function destroy(ExemptionVariation $exemption_variation)
    {
        $exemption_variation->delete();
        return redirect()->route('exemption_variations.index')->with('success', 'Application deleted successfully!');
    }
  
   
    public function approve(Request $request, $id)
        {
    
    $app = ExemptionVariation::findOrFail($id);
       $validated = $request->validate([
        'approved_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);
  // Log::debug('Application validated');
    // Upload approved document if provided
    if ($request->hasFile('approved_document')) {
          //Log::debug('File exists');
        $path = $request->file('approved_document')->store('approved_documents', 'public');
        $app->approved_document = $path;
    }
     
    $app->status = 'Approved';
    $app->save();

    //return redirect()->back()->with('success', 'Application approved successfully.');
    return redirect()->route('exemption_variations.index')->with('success', 'Application approved successfully!');

}



public function downloadApprovedDocument($id)
{
    $application = ExemptionVariation::findOrFail($id);

    if (!$application->approved_document || !Storage::disk('public')->exists($application->approved_document)) {
        return back()->with('error', 'No approved document found.');
    }
   // Extract the file extension
    $extension = pathinfo($application->approved_document, PATHINFO_EXTENSION);

    // Create a clean filename for the download
    $downloadName = 'Approved_Document_' . $application->employer_name . '.' . $extension;

    return response()->download(storage_path('app/public/' . $application->approved_document), $downloadName);
}

public function showApprovalForm($id)
{
    $application =ExemptionVariation::findOrFail($id);
    $sections = Section::orderBy('name')->get();
    return view('exemption_variations.showApprovalForm', compact('application', 'sections'));
}


public function downloadpdf($id)
{
     $application = ExemptionVariation::findOrFail($id);

    $pdf = Pdf::loadView('exemption_variations.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->applicant_name . '.pdf');
}


public function downloadSubmission($id)
{
    $application = ExemptionVariation::findOrFail($id);
   
    $media = $application->getFirstMedia('submission_document');

    if (!$media) {
        return back()->with('error', 'No submission document found.');
    }

    return response()->download(
        $media->getPath(),
        'Submission_' . $application->employer_name . '.' . $media->extension
    );
}
public function previewSubmission($id)
{
    $application = ExemptionVariation::findOrFail($id);
     
    $media = $application->getFirstMedia('submission_document');

    if (!$media) {
        abort(404, 'submission not found');
    }

    return response()->file(
        $media->getPath(),
        [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $media->file_name . '"',
        ]
    );

}
public function declarationView()
    {
         $applications = ExemptionVariation::latest()->paginate(10);
       return view('exemption_variations.declarationView', compact('applications'));
    }
}
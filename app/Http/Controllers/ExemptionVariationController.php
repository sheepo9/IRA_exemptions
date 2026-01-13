<?php

namespace App\Http\Controllers;

use App\Models\Exemption_Variation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $applications = Exemption_Variation::latest()->paginate(10);
        return view('exemption_variations.index', compact('applications'));
    }

    public function create()
    {
        return view('exemption_variations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'address' => 'required|string',
            'sections_sought' => 'required|string',
            'categories_affected' => 'nullable|string',
            'representative_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'application_date' => 'required|date',
        ]);

       Exemption_Variation::create($validated);

        return redirect()->route('exemption_variations.index')->with('success', 'Application submitted successfully!');
    }

    public function show(Exemption_Variation  $exemption_variation)
    {
        return view('exemption_variations.show', compact('exemption_variation'));
    }

    public function edit(Exemption_Variation $exemption_variation)
    {
        return view('exemption_variations.edit', compact('exemption_variation'));
    }

    public function update(Request $request, Exemption_Variation $exemption_variation)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'address' => 'required|string',
            'sections_sought' => 'required|string',
            'categories_affected' => 'nullable|string',
            'representative_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'application_date' => 'required|date',
        ]);

        $exemption_variation->update($validated);

        return redirect()->route('exemption_variations.index')->with('success', 'Application updated successfully!');
    }

    public function destroy(Exemption_Variation $exemption_variation)
    {
        $exemption_variation->delete();
        return redirect()->route('exemption_variations.index')->with('success', 'Application deleted successfully!');
    }
    public function approve(Request $request, $id)
        {
    
    $app = Exemption_Variation::findOrFail($id);
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
    $application = Exemption_Variation::findOrFail($id);

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
    $application =Exemption_Variation::findOrFail($id);
    return view('exemption_variations.showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = Exemption_Variation::findOrFail($id);

    $pdf = Pdf::loadView('exemption_variations.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->employer_name . '.pdf');
}

}

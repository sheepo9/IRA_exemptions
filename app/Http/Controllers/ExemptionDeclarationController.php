<?php

namespace App\Http\Controllers;

use App\Models\ExemptionDeclaration;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ExemptionDeclarationController extends Controller
{public function __construct()
{
    $this->middleware('permission:exemption-declaration-list|exemption-declaration-create|exemption-declaration-edit|exemption-declaration-delete', ['only' => ['index','store']]);
    $this->middleware('permission:exemption-declaration-create', ['only' => ['create','store']]);
    $this->middleware('permission:exemption-declaration-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:exemption-declaration-delete', ['only' => ['destroy']]);
}

        public function index()
    {
        $declarations = ExemptionDeclaration::latest()->paginate(10);
        return view('exemption_declarations.index', compact('declarations'));
    }

    public function create()
    {
        return view('exemption_declarations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'minister_name' => 'required|string|max:255',
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
            'exemption_sections' => 'nullable|string',
            'variation_sections' => 'nullable|string',
            'effective_from' => 'required|date',
            'effective_to' => 'required|date|after_or_equal:effective_from',
            'signed_date' => 'required|date',
        ]);

        ExemptionDeclaration::create($validated);
        return redirect()->route('exemption_declarations.index')
                         ->with('success', 'Declaration recorded successfully.');
    }

    public function show(ExemptionDeclaration $exemption_declaration)
    {
        return view('exemption_declarations.show', compact('exemption_declaration'));
    }

    public function edit(ExemptionDeclaration $exemption_declaration)
    {
        return view('exemption_declarations.edit', compact('exemption_declaration'));
    }

    public function update(Request $request, ExemptionDeclaration $exemption_declaration)
    {
        $validated = $request->validate([
            'minister_name' => 'required|string|max:255',
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
            'exemption_sections' => 'nullable|string',
            'variation_sections' => 'nullable|string',
            'effective_from' => 'required|date',
            'effective_to' => 'required|date|after_or_equal:effective_from',
            'signed_date' => 'required|date',
        ]);

        $exemption_declaration->update($validated);
        return redirect()->route('exemption_declarations.index')
                         ->with('success', 'Declaration updated successfully.');
    }

    public function destroy(ExemptionDeclaration $exemption_declaration)
    {
        $exemption_declaration->delete();
        return redirect()->route('exemption_declarations.index')
                         ->with('success', 'Declaration deleted successfully.');
    }
    public function approve(Request $request, $id)
        {
    
    $app = ExemptionDeclaration::findOrFail($id);
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

    return redirect()->back()->with('success', 'Application approved successfully.');
}



public function downloadApprovedDocument($id)
{
    $application = ExemptionDeclaration::findOrFail($id);

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
    $application =ExemptionDeclaration::findOrFail($id);
    return view('exemption_declarations.showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = ExemptionDeclaration::findOrFail($id);

    $pdf = Pdf::loadView('exemption_declarations.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->employer_name . '.pdf');
}

}

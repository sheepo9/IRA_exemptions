<?php

namespace App\Http\Controllers;

use App\Models\ExemptionApplication;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Section;
use App\Http\Controllers\Log;

class ExemptionApplicationController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:exemption-application-list|exemption-application-create|exemption-application-edit|exemption-application-delete', ['only' => ['index','store']]);
    $this->middleware('permission:exemption-application-create', ['only' => ['create','store']]);
    $this->middleware('permission:exemption-application-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:exemption-application-delete', ['only' => ['destroy']]);
}

     public function index()
    {
        $applications = ExemptionApplication::latest()->paginate(10);
        return view('exemption_applications.index', compact('applications'));
    }

    public function create()
    {
        $sections = Section::orderBy('section_name')->get();
        return view('exemption_applications.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'nullable|string',
            'postal_address' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
            'fax' => 'nullable|string|max:30',
            'email' => 'nullable|email',
            'sector' => 'nullable|string',
            'num_employees' => 'nullable|integer',
            'submitted_first_report' => 'nullable|boolean',
            'report_reason' => 'nullable|string',
            'report_date' => 'nullable|date',
            'supporting_statement' => 'nullable|string',
            'actions_taken' => 'nullable|string',
            'representative_name' => 'nullable|string',
            'position' => 'nullable|string',
            'date_submitted' => 'nullable|date',
        ]);

        ExemptionApplication::create($validated);

        return redirect()->route('exemption-applications.index')
                         ->with('success', 'Exemption application submitted successfully.');
    }




    
    public function show(ExemptionApplication $exemptionApplication)
    {
        return view('exemption_applications.show', compact('exemptionApplication'));
    }

    public function edit(ExemptionApplication $exemptionApplication)
    {
        return view('exemption_applications.edit', compact('exemptionApplication'));
    }

    public function update(Request $request, ExemptionApplication $exemptionApplication)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'nullable|string',
            'postal_address' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
            'fax' => 'nullable|string|max:30',
            'email' => 'nullable|email',
            'sector' => 'nullable|string',
            'num_employees' => 'nullable|integer',
            'submitted_first_report' => 'nullable|boolean',
            'report_reason' => 'nullable|string',
            'report_date' => 'nullable|date',
            'supporting_statement' => 'nullable|string',
            'actions_taken' => 'nullable|string',
            'representative_name' => 'nullable|string',
            'position' => 'nullable|string',
            'date_submitted' => 'nullable|date',
        ]);

        $exemptionApplication->update($validated);

        return redirect()->route('exemption-applications.index')
                         ->with('success', 'Exemption application updated successfully.');
    }

    public function destroy(ExemptionApplication $exemptionApplication)
    {
        $exemptionApplication->delete();
        return redirect()->route('exemption-applications.index')
                         ->with('success', 'Exemption application deleted successfully.');
    }
    

public function approve(Request $request, $id)
{
    
    $application = ExemptionApplication::findOrFail($id);
    
    $validated = $request->validate([
        'approved_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);
   Log::debug('Application validated');
    // Upload approved document if provided
    if ($request->hasFile('approved_document')) {
          Log::debug('File exists');
        $path = $request->file('approved_document')->store('approved_documents', 'public');
        $app->approved_document = $path;
    }
     
    $app->status = 'Approved';
    $app->save();
 Log::debug('File exists3');
    return redirect()->route('exemption-applications.index')
                         ->with('success', 'Exemption application submitted successfully.');
    
    //return redirect()->back()->with('success', 'Application approved successfully.');
}



public function downloadApprovedDocument($id)
{
    $application = ExemptionApplication::findOrFail($id);

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
    $application = ExemptionApplication::findOrFail($id);


    return view('exemption_applications.showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = ExemptionApplication::findOrFail($id);

    $pdf = Pdf::loadView('exemption_applications.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->applicant_name . '.pdf');
}
}

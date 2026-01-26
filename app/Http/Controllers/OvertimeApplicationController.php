<?php

namespace App\Http\Controllers;

use App\Models\OvertimeApplication;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OvertimeApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
{
    $this->middleware('permission:overtime-application-list|overtime-application-create|overtime-application-edit|overtime-application-delete', ['only' => ['index','store']]);
    $this->middleware('permission:overtime-application-create', ['only' => ['create','store']]);
    $this->middleware('permission:overtime-application-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:overtime-application-delete', ['only' => ['destroy']]);
}

    public function index()
    {
        $applications = OvertimeApplication::latest()->paginate(10);
        return view('overtime_applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('overtime_applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employer_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'postal_address' => 'required|string',
            'tel_no' => 'required|string|max:20',
            'email' => 'required|email',
            'motivation' => 'nullable|string',
            'proposed_daily_limit' => 'nullable|string',
            'proposed_weekly_limit' => 'nullable|string',
            'work_on_sundays' => 'nullable|boolean',
            'class_of_employees' => 'nullable|string',
                        'period_sought' => 'nullable|string',
            'signature_date' => 'nullable|date',
              'employee_consent_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

       $application = OvertimeApplication::create($validated);

    // ✅ Spatie Media Upload
    if ($request->hasFile('employee_consent_document')) {
        $application
            ->addMediaFromRequest('employee_consent_document')
            ->toMediaCollection('employee_consent');
    }


        return redirect()->route('overtime-applications.index')
                         ->with('success', 'Overtime application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OvertimeApplication $overtimeApplication)
    {
        return view('overtime_applications.show', compact('overtimeApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimeApplication $overtimeApplication)
    {
        return view('overtime_applications.edit', compact('overtimeApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OvertimeApplication $overtimeApplication)
    {
        $validated = $request->validate([
            'employer_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'postal_address' => 'required|string',
            'tel_no' => 'required|string|max:20',
            'email' => 'required|email',
            'motivation' => 'nullable|string',
            'proposed_daily_limit' => 'nullable|string',
            'proposed_weekly_limit' => 'nullable|string',
            'work_on_sundays' => 'nullable|boolean',
            'class_of_employees' => 'nullable|string',
            'employee_consent_link' => 'nullable|string',
            'period_sought' => 'nullable|string',
            'signature_date' => 'nullable|date',
            'employee_consent_document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',

        ]);

        
                $overtimeApplication->update($validated);

                // ✅ Replace existing consent document (singleFile())
                if ($request->hasFile('employee_consent_document')) {
                    $overtimeApplication
                        ->addMediaFromRequest('employee_consent_document')
                        ->toMediaCollection('employee_consent');

        return redirect()->route('overtime-applications.index')
                         ->with('success', 'Overtime application updated successfully.');
    }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OvertimeApplication $overtimeApplication)
    {
        $overtimeApplication->delete();

        return redirect()->route('overtime-applications.index')
                         ->with('success', 'Overtime application deleted successfully.');
    }
    
public function approve(Request $request, $id)
{
    
    $app = OvertimeApplication::findOrFail($id);
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

    return redirect()->back()->with('success', 'Application approved successfully.');
}



public function downloadApprovedDocument($id)
{
    $application = OvertimeApplication::findOrFail($id);

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
    $application =OvertimeApplication::findOrFail($id);
    return view('overtime_applications.showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = OvertimeApplication::findOrFail($id);

    $pdf = Pdf::loadView('overtime_applications.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->employer_name . '.pdf');
}



}

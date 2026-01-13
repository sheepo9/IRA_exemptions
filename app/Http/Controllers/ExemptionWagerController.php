<?php

namespace App\Http\Controllers;

use App\Models\ExemptionWager;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ExemptionWagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
{
    $this->middleware('permission:exemption-wager-list|exemption-wager-create|exemption-wager-edit|exemption-wager-delete', ['only' => ['index','store']]);
    $this->middleware('permission:exemption-wager-create', ['only' => ['create','store']]);
    $this->middleware('permission:exemption-wager-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:exemption-wager-delete', ['only' => ['destroy']]);
}

   public function index()
    {
        $applications = ExemptionWager::latest()->paginate(10);
        return view('exemption_wagers.index', compact('applications'));
    }

    public function create()
    {
        return view('exemption_wagers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'required|string',
            'postal_address' => 'nullable|string',
            'phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'email' => 'nullable|email',
            'sector_industry' => 'required|string|max:255',
            'wage_order_name' => 'required|string',
            'detailed_statement' => 'nullable|string',
            'representative_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'application_date' => 'required|date',
        ]);

        ExemptionWager::create($validated);
        return redirect()->route('exemption_wagers.index')->with('success', 'Application submitted successfully!');
    }

    public function show(ExemptionWager $exemption_wager)
    {
        return view('exemption_wagers.show', compact('exemption_wager'));
    }

    public function edit(ExemptionWager $exemption_wager)
    {
        return view('exemption_wagers.edit', compact('exemption_wager'));
    }

    public function update(Request $request, ExemptionWager $exemption_wager)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'physical_address' => 'required|string',
            'postal_address' => 'nullable|string',
            'phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'email' => 'nullable|email',
            'sector_industry' => 'required|string|max:255',
            'wage_order_name' => 'required|string',
            'detailed_statement' => 'nullable|string',
            'representative_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'application_date' => 'required|date',
        ]);

        $exemption_wager->update($validated);
        return redirect()->route('exemption_wagers.index')->with('success', 'Application updated successfully!');
    }

    public function destroy(ExemptionWager $exemption_wager)
    {
        $exemption_wager->delete();
        return redirect()->route('exemption_wagers.index')->with('success', 'Application deleted successfully!');
    }

public function approve(Request $request, $id)
        {
    
    $app = ExemptionWager::findOrFail($id);
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
    return redirect()->route('exemption_wagers.index')->with('success', 'Application approved successfully!');

}



public function downloadApprovedDocument($id)
{
    $application = ExemptionWager::findOrFail($id);

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
    $application =ExemptionWager::findOrFail($id);
    return view('exemption_wagers..showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = ExemptionWager::findOrFail($id);

    $pdf = Pdf::loadView('exemption_wagers.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->employer_name . '.pdf');
}



}

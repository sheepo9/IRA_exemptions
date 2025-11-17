<?php

namespace App\Http\Controllers;

use App\Models\Continuous_operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
//use App\Http\Controllers\Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Permission;


class ContinuousOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
{
    $this->middleware('permission:operation-list|operation-create|operation-edit|operation-delete', ['only' => ['index','store']]);
    $this->middleware('permission:operation-create', ['only' => ['create','store']]);
    $this->middleware('permission:operation-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:operation-delete', ['only' => ['destroy']]);
}

    public function index()
    {
        //$applications = Continuous_operation::latest()->paginate(10);

         if (Auth::user()->hasRole('Administrator')) {
        // Admin sees all applications
        $applications = Continuous_operation::latest()->paginate(10);
    } else {
        // Regular user sees only their own applications
        $applications = Continuous_operation::where('user_id', Auth::id())
                                            ->latest()
                                            ->paginate(10);

    }
        return view('continuous_operation.index', compact('applications'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('continuous_operation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ 1. Validate incoming request
        $validated = $request->validate([
                'employer_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'postal_address' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'nature_of_business' => 'nullable|string',
            'motivation' => 'nullable|string',
            'period' => 'nullable|string|max:255',
            'employee_categories' => 'nullable|string',
            'number_of_shifts' => 'nullable|integer',
            'hours_per_shift' => 'nullable|integer',
            'off_days' => 'nullable|string|max:255',
            'shift_roster' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls|max:2048',
            'signature' => 'nullable|string|max:255',
            'date_signed' => 'nullable|date',
        ]);

        // ✅ 2. Handle file upload (if exists)
        if ($request->hasFile('shift_roster')) {
            $validated['shift_roster'] = $request->file('shift_roster')->store('shift_rosters', 'public');
        }
        // ✅ 3. Assign user_id manually
            $validated['user_id'] = Auth::id();

        // ✅ 3. Save record in database
        Continuous_Operation::create($validated);

        // ✅ 4. Redirect back with success message
        return back()->with('success', 'Application submitted successfully!');
    }
      public function show($id)
{
    $application = Continuous_Operation::findOrFail($id);

    if (Auth::user()->hasRole('Administrator')) {
        // Admin sees all pending applications
        $applications = Continuous_operation::where('status', 'Pending')
                                            ->latest()
                                            ->paginate(10);
    } else {
        // Regular user sees only their own applications (Pending OR Approved)
        $applications = Continuous_operation::where('user_id', Auth::id())
                                            ->whereIn('status', ['Pending', 'Approved'])
                                            ->latest()
                                            ->paginate(10);
    }

    return view('continuous_operation.show', compact('application', 'applications'));
}

    
    /*
     * Display a specific application.
     
    public function show($id)
    {
          $application = Continuous_Operation::findOrFail($id);

    // Only Admins should see all applications for approval
    $applications = [];
    if (Auth::user()->hasRole('Administrator')) {
        $applications = Continuous_operation::where('status', 'Pending')
                                            ->latest()
                                            ->paginate(10);
    } else {
        // Regular user: only their own pending applications
        $applications = Continuous_operation::where('user_id', Auth::id())
                                            ->where('status', 'Pending')
                                            ->where('status', 'Approved')
                                            ->latest()
                                            ->paginate(10);
    }
        return view('continuous_operation.show', compact('application', 'applications'));
    }
*/
    /**
     * Show the form for editing an application.
     */
    public function edit($id)
    {
        $application = Continuous_Operation::findOrFail($id);
        return view('continuous_operation.edit', compact('application'));
    }

    /**
     * Update an existing application.
     */
    public function update(Request $request, $id)
    {
        $application = Continuous_Operation::findOrFail($id);

        $validated = $request->validate([
            'employer_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
            'postal_address' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'nature_of_business' => 'nullable|string',
            'motivation' => 'nullable|string',
            'period' => 'nullable|string|max:255',
            'employee_categories' => 'nullable|string',
            'number_of_shifts' => 'nullable|integer',
            'hours_per_shift' => 'nullable|integer',
            'off_days' => 'nullable|string|max:255',
            'shift_roster' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls|max:2048',
            'signature' => 'nullable|string|max:255',
            'date_signed' => 'nullable|date',
        ]);

        // ✅ Handle new file upload (if replacing existing one)
        if ($request->hasFile('shift_roster')) {
            // Delete old file if it exists
            if ($application->shift_roster && Storage::disk('public')->exists($application->shift_roster)) {
                Storage::disk('public')->delete($application->shift_roster);
            }
            $validated['shift_roster'] = $request->file('shift_roster')->store('shift_rosters', 'public');
        }

        $application->update($validated);

        return redirect()->route('operations.index')->with('success', 'Application updated successfully!');
    }

    /**
     * Remove an application from storage.
     */
    public function destroy($id)
    {
        $application = Continuous_Operation::findOrFail($id);

        // Delete associated file
        if ($application->shift_roster && Storage::disk('public')->exists($application->shift_roster)) {
            Storage::disk('public')->delete($application->shift_roster);
        }

        $application->delete();

        return redirect()->route('operations.index')->with('success', 'Application deleted successfully!');
    }



public function approve(Request $request, $id)
{
    
    $application = Continuous_Operation::findOrFail($id);
       $validated = $request->validate([
        'approved_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);
   Log::debug('Application validated');
    // Upload approved document if provided
    if ($request->hasFile('approved_document')) {
          Log::debug('File exists');
        $path = $request->file('approved_document')->store('approved_documents', 'public');
        $application->approved_document = $path;
    }
     
    $application->status = 'Approved';
    $application->save();

    return redirect()->back()->with('success', 'Application approved successfully.');
}



public function downloadApprovedDocument($id)
{
    $application = Continuous_Operation::findOrFail($id);

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
    $application = Continuous_Operation::findOrFail($id);

    // Optional: check if user has permission to approve
    // if (!Auth::user()->hasRole('Administrator')) {
    //     abort(403);
    // }

    return view('continuous_operation.showApprovalForm', compact('application'));
}


public function downloadpdf($id)
{
     $application = Continuous_Operation::findOrFail($id);

    $pdf = Pdf::loadView('continuous_operation.show_pdf', [
        'application' => $application
    ]);

    return $pdf->download('application_' . $application->employer_name . '.pdf');
}



}

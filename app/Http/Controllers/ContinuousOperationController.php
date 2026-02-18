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

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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

    public function index(Request $request)
    {
     $user = auth()->user();

    $query = Continuous_operation::query();
   
if ($user->hasRole('User')) {
   $query->where('user_id', $user->id)
      ->where(function ($q) {
          $q->whereIn('status', ['pending','rejected_by_staff'])
            ->orWhereIn('user_status', ['pending','approved']);
      });

}

if ($user->hasRole('Deputy_Director')) {
    $query->whereIn('status', [
        'reviewed_by_staff','rejected_by_ded'
    ]);
}
if ($user->hasRole('Deputy_Executive_Director')) {
    $query->whereIn('status', [
        'approved_by_dd','rejected_by_ed'
            ]);
}

    if ($user->hasRole('Executive_Director')) {
        $query->where('status', 'approved_by_ded');
    }
if ($user->hasRole('Administrator')) {
    $query->whereIn('status', [
        'pending','rejected_by_dd'
    ]);
}
if ($user->hasRole('Minister')) {
    $query->whereIn('status', [
        'pending','approved_by_ed'
    ]);
}
   $status = $request->status;

    $applications = Continuous_operation::when($status, function ($q) use ($status) {
        $q->where('status', $status);
    })->get();


    $applications = $query->paginate(10);
      return view('continuous_operation.index', compact('applications'));
    }
      
    public function applications(Request $request)
{
    $status = $request->query('status');          // e.g., pending
    $user_status = $request->query('user_status'); // e.g., approved, rejected

    $applications = Continuous_operation::query()
        ->when($status, fn($q) => $q->where('status', $status))
        ->when($user_status, fn($q) => $q->where('user_status', $user_status))
        ->latest()
        ->get();

    return view('continuous_operation.applications', compact('applications', 'status', 'user_status'));
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
    // ✅ 1. Validate request
    $validated = $request->validate([
        'employer_name'        => 'required|string|max:255',
        'registration_number' => 'nullable|string|max:100',
        'contact_person'      => 'nullable|string|max:255',
        'postal_address'      => 'nullable|string|max:255',
        'telephone'           => 'nullable|string|max:50',
        'email'               => 'nullable|email|max:255',
        'nature_of_business'  => 'nullable|string',
        'motivation'          => 'nullable|string',
        'period'              => 'nullable|string|max:255',
        'employee_categories' => 'nullable|string',
        'number_of_shifts'    => 'nullable|integer',
        'hours_per_shift'     => 'nullable|integer',
        'off_days'            => 'nullable|string|max:255',
        'shift_roster'        => 'required|file|mimes:pdf,doc,docx,xlsx,xls|max:2048',
        'signature'           => 'nullable|string|max:255',
        'date_signed'         => 'nullable|date',
    ]);

    // ✅ 2. Attach user
    $validated['user_id'] = Auth::id();

    // ✅ 3. Create application FIRST
    $application = Continuous_Operation::create($validated);

    // ✅ 4. Upload shift roster via Spatie
    if ($request->hasFile('shift_roster')) {
        $application
            ->addMediaFromRequest('shift_roster')
            ->usingName('Shift Roster')
            ->toMediaCollection('shift_rosters');
    }

    return back()->with('success', 'Application submitted successfully!');
}

        public function show($id)
{
    $application = Continuous_Operation::findOrFail($id);
   //$this->authorize('view', $application);
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
            //$this->authorize('update', $application);

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

     $application->update($validated);

    if ($request->hasFile('shift_roster')) {
        $application
            ->clearMediaCollection('shift_rosters')
            ->addMediaFromRequest('shift_roster')
            ->toMediaCollection('shift_rosters');
    }

    return redirect()->route('operations.index')
        ->with('success', 'Application updated successfully!');
}

    /**
     * Remove an application from storage.
     */
    public function destroy($id)
    {
        $application = Continuous_Operation::findOrFail($id);
        $this->authorize('delete', $application); 
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
      $this->authorize('approve', $application);

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

   // return redirect()->back()->with('success', 'Application approved successfully.');
    return redirect()->route('operations.index')->with('success', 'Application approved successfully!');
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
public function downloadShiftRoster($id)
{
    $application = Continuous_Operation::findOrFail($id);
    //$this->authorize('downloadShiftRoster', $application);
    $media = $application->getFirstMedia('shift_rosters');

    if (!$media) {
        return back()->with('error', 'No shift roster found.');
    }

    return response()->download(
        $media->getPath(),
        'Shift_Roster_' . $application->employer_name . '.' . $media->extension
    );
}
public function previewShiftRoster($id)
{
    $application = Continuous_Operation::findOrFail($id);
     //$this->authorize('view', $application);
    $media = $application->getFirstMedia('shift_rosters');

    if (!$media) {
        abort(404, 'Shift roster not found');
    }

    return response()->file(
        $media->getPath(),
        [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $media->file_name . '"',
        ]
    );
}


public function review(Request $request, Continuous_Operation $ContinuosApplication)
{
    $user = auth()->user();

    switch ($request->action) {

        // ===== Administrator =====
        case 'staff_approve':
            $request->validate(['staff_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'staff_comment' => $request->staff_comment,
                'status' => 'reviewed_by_staff',
            ]);
            break;

        case 'staff_reject':
            $request->validate(['staff_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'staff_comment' => $request->staff_comment,
                'status' => 'rejected_by_staff',
            ]);
            break;

        // ===== Deputy Director =====
        case 'dd_approve':
            $request->validate(['dd_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'DD_comment' => $request->dd_comment,
                'status' => 'approved_by_dd',
            ]);
            break;

        case 'dd_reject':
            $request->validate(['dd_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'DD_comment' => $request->dd_comment,
                'status' => 'rejected_by_dd',
            ]);
            break;

        // ===== Deputy Executive Director =====
        case 'ded_approve':
            $request->validate(['ded_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'ded_comment' => $request->ded_comment,
                'status' => 'approved_by_ded',
            ]);
            break;

        case 'ded_reject':
            $request->validate(['ded_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'ded_comment' => $request->ded_comment,
                'status' => 'rejected_by_ded',
            ]);
            break;

        /* ===== Executive Director =====
        case 'ed_approve':
            $request->validate(['ed_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'ed_comment' => $request->ed_comment,
                'status' => 'approved_by_ed', 
                'user_status' => 'approved', // final
            ]);
            break;

        case 'ed_reject':
            $request->validate(['ed_comment' => 'nullable|string']);
           $ContinuosApplication->update([
                'ed_comment' => $request->ed_comment,
                'status' => 'rejected_by_ed', // final
            ]);
            break;    */ 
        case 'ed_approve':
       case 'ed_reject':
            // Validate both comment and optional file
            //dd('controller reached');

            $request->validate([
                'ed_comment' => 'nullable|string',
                'ed_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // max 5MB
            ]);

            // Update comment and status
           $ContinuosApplication->update([
                'ed_comment' => $request->ed_comment,
                'status' => $request->action === 'ed_approve' ? 'approved_by_ed' : 'rejected_by_ed',
                 'user_status' => 'approved', // final
            ]);

           if ($request->hasFile('ed_file')) {

            Log::info('ED file detected');
                Log::info('ED file upload', [
                    'file' => $request->file('ed_file'),
                ]);

                    // Remove old ED file if exists
                   $ContinuosApplication->clearMediaCollection('ed_files');

                    // Add new ED file to 'ed_files' collection
                   $ContinuosApplication
                        ->addMediaFromRequest('ed_file')
                        ->toMediaCollection('ed_files', 'public'); // optional: use public disk for public access
                }

            break;

            /*
            case 'minister_approve':
       case 'minister_reject':
            // Validate both comment and optional file
            //dd('controller reached');

            $request->validate([
                'minister_comment' => 'nullable|string',
                'minister_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // max 5MB
            ]);

            // Update comment and status
           $ContinuosApplication->update([
                'minister_comment' => $request->ed_comment,
                'status' => $request->action === 'minister_approve' ? 'approved_by_minister' : 'rejected_by_minister',
                 'user_status' => 'approved', // final
            ]);

           if ($request->hasFile('minister_file')) {

            Log::info('ED file detected');
                Log::info('ED file upload', [
                    'file' => $request->file('ed_file'),
                ]);

                    // Remove old ED file if exists
                   $ContinuosApplication->clearMediaCollection('minister_files');

                    // Add new ED file to 'ed_files' collection
                   $ContinuosApplication
                        ->addMediaFromRequest('minister_file')
                        ->toMediaCollection('minister_files', 'public'); // optional: use public disk for public access
                }

            break;*/

            case 'minister_approve':

    /*$request->validate([
        'minister_comment' => 'nullable|string',
    ]);

    // Generate Reference
    $reference = 'CO-' . now()->format('Y') . '-' . str_pad($ContinuosApplication->id, 5, '0', STR_PAD_LEFT);

    // Generate Verification Hash
    $hash = hash('sha256', $reference . $ContinuosApplication->employer_name . now());

    // Update application
    $ContinuosApplication->update([
        'minister_comment' => $request->minister_comment,
        'status' => 'approved_by_minister',
        'user_status' => 'approved',
        'approval_reference' => $reference,
        'approval_hash' => $hash,
        'approved_at' => now(),
    ]);

    // Generate PDF
    $pdf = Pdf::loadView('continuous_operation.approval_pdf', [
        'application' => $ContinuosApplication,
        'reference' => $reference,
        'hash' => $hash,
    ])->output();



    // Remove old approval if exists
    $ContinuosApplication->clearMediaCollection('approval_certificates');

    // Store using Media Library
    $ContinuosApplication
        ->addMediaFromString($pdf)
        ->usingFileName('Approval_' . $reference . '.pdf')
        ->toMediaCollection('approval_certificates', 'public');
*/

$request->validate([
    'minister_comment' => 'nullable|string',
]);

// Generate Reference
$reference = 'CO-' . now()->format('Y') . '-' . str_pad($ContinuosApplication->id, 5, '0', STR_PAD_LEFT);

// Generate Verification Hash
$hash = hash('sha256', $reference . $ContinuosApplication->employer_name . now());

// Generate Verification URL
$verificationUrl = route('verify.certificate', [
    'reference' => $reference,
    'hash' => $hash
]);

// Create QR as SVG (NO GD REQUIRED)
$renderer = new ImageRenderer(
    new RendererStyle(180),
    new SvgImageBackEnd()
);

$writer = new Writer($renderer);
$qrCode = $writer->writeString($verificationUrl);

// Update application
$ContinuosApplication->update([
    'minister_comment' => $request->minister_comment,
    'status' => 'approved_by_minister',
    'user_status' => 'approved',
    'approval_reference' => $reference,
    'approval_hash' => $hash,
    'approved_at' => now(),
]);

// Generate PDF WITH QR
$pdf = Pdf::loadView('continuous_operation.approval_pdf', [
    'application' => $ContinuosApplication,
    'reference' => $reference,
    'hash' => $hash,
    'qrCode' => $qrCode
])->output();

// Remove old approval if exists
$ContinuosApplication->clearMediaCollection('approval_certificates');

// Store using Media Library
$ContinuosApplication
    ->addMediaFromString($pdf)
    ->usingFileName('Approval_' . $reference . '.pdf')
    ->toMediaCollection('approval_certificates', 'public');


    break;


        default:
            abort(400, 'Invalid action.');
    }

   return redirect()->route('operations.index')
                 ->with('success', 'Application updated successfully!');

} 

                
public function downloadDEDFile($id)
{
    $application = Continuous_Operation::findOrFail($id);

    $media = $application->getFirstMedia('ed_files');

    if (!$media) {
        return back()->with('error', 'No DED document found.');
    }

    return response()->download(
        $media->getPath(),
        'DED_' . $application->employer_name . '.' . $media->extension // adjust as needed
    );
}
public function previewDEDFile($id)
{
    $application = Continuous_Operation::findOrFail($id);

    $media = $application->getFirstMedia('ed_files');

    if (!$media) {
        abort(404, 'DED document not found.');
    }

    return response()->file(
        $media->getPath(),
        [
            'Content-Type' => $media->mime_type, // automatically detect MIME type
            'Content-Disposition' => 'inline; filename="' . $media->file_name . '"',
        ]
    );
}
public function downloadApproval($id)
{
    $application = Continuous_Operation::findOrFail($id);

    $media = $application->getFirstMedia('approval_certificates');

    if (!$media) {
        return back()->with('error', 'Approval certificate not found.');
    }

    return response()->download(
        $media->getPath(),
        $media->file_name
    );
}
public function verify($reference, $hash)
{
    $application = Continuous_Operation::where('approval_reference', $reference)->firstOrFail();

    if ($application->approval_hash !== $hash) {
        abort(403, 'Invalid certificate');
    }

    return view('verification.valid', compact('application'));
}



}

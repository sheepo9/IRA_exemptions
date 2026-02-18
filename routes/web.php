<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExemptionWagerController;
use App\Http\Controllers\ExemptionVariationController;
use App\Http\Controllers\ContinuousOperationController;
use App\Http\Controllers\OvertimeApplicationController;
use App\Http\Controllers\ExemptionApplicationController;
use App\Http\Controllers\ExemptionDeclarationController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class, 'index'], function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();
require __DIR__.'/auth.php';
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('operations', ContinuousOperationController::class);
    Route::resource('overtime-applications', OvertimeApplicationController::class);
    Route::resource('exemption-applications', ExemptionApplicationController::class);
    Route::resource('exemption_wagers', ExemptionWagerController::class);
    Route::resource('exemption_variations', ExemptionVariationController::class);
    Route::resource('exemption_declarations', ExemptionDeclarationController::class);
    
    // custom routes
    Route::post('operations/{id}/approve', [ContinuousOperationController::class, 'approve'])
    ->name('operations.approve');
Route::get('/operations/{id}/approve', [ContinuousOperationController::class, 'showApprovalForm'])->name('operations.approve.form');

// ✅ Route for downloading the approved document
Route::middleware(['auth'])->group(function () {
    Route::get('/operations/{id}/download-approval',
        [ContinuousOperationController::class, 'downloadApproval']
    )->name('operations.downloadApproval');
});


    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('operations/{id}/pdf', [ContinuousOperationController::class, 'downloadPdf'])
        ->name('operations.pdf');


Route::put(
    '/operations/{ContinuosApplication}/review',
    [ContinuousOperationController::class, 'review']
)->name('operations.review');

Route::get('operations/{id}/ded-download', [ContinuousOperationController::class, 'downloadDEDFile'])
     ->name('operations.minister-download');

Route::get('operations/{id}/ded-preview', [ContinuousOperationController::class, 'previewDEDFile'])
     ->name('operations.minister-preview');


Route::middleware(['auth'])->group(function () {

    Route::get('/continouos_operations', 
        [ContinuousOperationController::class, 'applications']
    )->name('operations.applications');

});

Route::get('/acting-ded-notice', [ContinuousOperationController::class, 'actingDed']);

Route::get('/verify/{reference}/{hash}', [ContinuousOperationController::class, 'verify'])
    ->name('verify.certificate');

//_--------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------
//---------------                      Exemption Applications ---------------------------------------

 // custom routes
    Route::post('Exemption_Applications/{id}/approve', [ExemptionApplicationController::class, 'approve'])
    ->name('Exemption_Applications.approve');
Route::get('/Exemption_Applications/{id}/approve', [ExemptionApplicationController::class, 'showApprovalForm'])->name('operations.approve.form');

// ✅ Route for downloading the approved document
    Route::get('Exemption_Applications/{id}/download', [ExemptionApplicationController::class, 'downloadApprovedDocument'])
        ->name('Exemption_Applications.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('Exemption_Applications/{id}/pdf', [ExemptionApplicationController::class, 'downloadPdf'])
        ->name('Exemption_Applications.pdf');

//_--------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------
//-------------------------------------Overtime Applications ---------------------------------------
// custom routes
    Route::post('Overtime_Applications/{id}/approve', [OvertimeApplicationController::class, 'approve'])
    ->name('Overtime_Applications.approve');
Route::get('/Overtime_Applications/{id}/approve', [OvertimeApplicationController::class, 'showApprovalForm'])->name('Overtime_Applications.approve.form');

// ✅ Route for downloading the approved document
    Route::get('Overtime_Applications/{id}/download', [OvertimeApplicationController::class, 'downloadApprovedDocument'])
        ->name('Overtime_Applications.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('Overtime_Applications/{id}/pdf', [OvertimeApplicationController::class, 'downloadPdf'])
        ->name('Overtime_Applications.pdf');

Route::put(
    '/overtime-applications/{overtimeApplication}/review',
    [OvertimeApplicationController::class, 'review']
)->name('overtime-applications.review');

Route::get('overtime-applications/{id}/ded-download', [OvertimeApplicationController::class, 'downloadDEDFile'])
     ->name('overtime-applications.ded-download');

Route::get('overtime-applications/{id}/ded-preview', [OvertimeApplicationController::class, 'previewDEDFile'])
     ->name('overtime-applications.ded-preview');


Route::middleware(['auth'])->group(function () {

    Route::get('/time', 
        [OvertimeApplicationController::class, 'applications']
    )->name('overtime-applications.applications');
 Route::get('/operations_view', 
        [ContinuousOperationController::class, 'applications']
    )->name('operations_view.applications');

});


//---------------------------------------------------------------------------------------------------
//-------------------------------------wager Applications ---------------------------------------
// custom routes
    Route::post('Wager_Applications/{id}/approve', [ExemptionWagerController::class, 'approve'])
    ->name('Wager_Applications.approve');
Route::get('/Wager_Applications/{id}/approve', [ExemptionWagerController::class, 'showApprovalForm'])->name('Wager_Applications.approve.form');

// ✅ Route for downloading the approved document
    Route::get('Wager_Applications/{id}/download', [ExemptionWagerController::class, 'downloadApprovedDocument'])
        ->name('Wager_Applications.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('Wager_Applications/{id}/pdf', [ExemptionWagerController::class, 'downloadPdf'])
        ->name('Wager_Applications.pdf');

//_--------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------
//-------------------------------------Exemption Variations ---------------------------------------
// custom routes
    Route::post('ExemptionVariations/{id}/approve', [ExemptionVariationController::class, 'approve'])
    ->name('Exemption_Variations.approve');
Route::get('/ExemptionVariations/{id}/approve', [ExemptionVariationController::class, 'showApprovalForm'])->name('Exemption_Variations.approve.form');

// ✅ Route for downloading the approved document
    Route::get('ExemptionVariations/{id}/download', [ExemptionVariationController::class, 'downloadApprovedDocument'])
        ->name('Exemption_Variations.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('ExemptionVariations/{id}/pdf', [ExemptionVariationController::class, 'downloadPdf'])
        ->name('Exemption_Variations.pdf');
Route::get(
    '/ExemptionVariations/{id}/submission/download',
    [ExemptionVariationController::class, 'downloadSubmission']
)->name('submission.download');
});
Route::middleware(['auth'])->group(function () {
Route::get(
    '/ExemptionVariations/{id}/submission/preview',
    [ExemptionVariationController::class, 'previewSubmission']
)->name('submission.preview');
});
Route::post(
    '/exemption-variations/{id}/approve',
    [ExemptionVariationController::class, 'review']
)->name('exemption_variations.approve');

Route::get(
    '/exemption-variations/reviewed',
    [ExemptionVariationController::class, 'reviewed']
)->name('exemption_variations.reviewed');

Route::get('/exemption-variations/completed', 
    [ExemptionVariationController::class, 'completed']
)->name('exemption_variations.completed');

Route::put(
    '/exemption-variations/{exemption_variation}/comment',
    [ExemptionVariationController::class, 'comment']
)->name('exemption_variations.comment');

Route::put(
    '/exemption_variations/{exemption_variation}/minister',
    [ExemptionVariationController::class, 'ministerDecision']
)->name('exemption_variations.minister');

//_--------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------
//-------------------------------------Exemption Declarations---------------------------------------
// custom routes
    Route::post('Exemption_Declarations/{id}/approve', [ExemptionDeclarationController::class, 'approve'])
    ->name('Exemption_Declarations.approve');
Route::get('/Exemption_Declarations/{id}/approve', [ExemptionDeclarationController::class, 'showApprovalForm'])->name('Exemption_Declarations.approve.form');

// ✅ Route for downloading the approved document
    Route::get('Exemption_Declarations/{id}/download', [ExemptionDeclarationController::class, 'downloadApprovedDocument'])
        ->name('Exemption_Declarations.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('Exemption_Declarations/{id}/pdf', [ExemptionDeclarationController::class, 'downloadPdf'])
        ->name('Exemption_Declarations.pdf');

Route::middleware(['auth'])->group(function () {
Route::get(
    '/operations/{id}/shift-roster/download',
    [ContinuousOperationController::class, 'downloadShiftRoster']
)->name('operations.shiftRoster.download');
});
Route::middleware(['auth'])->group(function () {
Route::get(
    '/operations/{id}/shift-roster/preview',
    [ContinuousOperationController::class, 'previewShiftRoster']
)->name('operations.shiftRoster.preview');
});

Route::get('/exemption-variation/declaration', 
    [ExemptionVariationController::class, 'declarationView']
)->name('exemption-variation.declaration');

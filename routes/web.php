<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    Route::get('operations/{id}/download', [ContinuousOperationController::class, 'downloadApprovedDocument'])
        ->name('operations.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('operations/{id}/pdf', [ContinuousOperationController::class, 'downloadPdf'])
        ->name('operations.pdf');


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


//_--------------------------------------------------------------------------------------------------
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
    Route::post('Exemption_Variations/{id}/approve', [ExemptionVariationController::class, 'approve'])
    ->name('Exemption_Variations.approve');
Route::get('/Exemption_Variations/{id}/approve', [ExemptionVariationController::class, 'showApprovalForm'])->name('Exemption_Variations.approve.form');

// ✅ Route for downloading the approved document
    Route::get('Exemption_Variations/{id}/download', [ExemptionVariationController::class, 'downloadApprovedDocument'])
        ->name('Exemption_Variations.download');

    // ✅ Route for generating or downloading PDF (admin or user)
    Route::get('Exemption_Variations/{id}/pdf', [ExemptionVariationController::class, 'downloadPdf'])
        ->name('Exemption_Variations.pdf');

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

//_--------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------
//-------------------------------------Exemption Declarations---------------------------------------

       

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
     ->name('dashboard')
     ->middleware('auth'); // Optional: add auth middleware if needed

    


});
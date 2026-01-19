<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExemptionWager;
use App\Models\ExemptionApplication;
use App\Models\ExemptionDeclaration;
use App\Models\ExemptionVariation;
use App\Models\Continuous_operation;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
         // Paginated data for tables (per page)
     $application = Continuous_Operation::latest()->paginate(10);
    $exemptionsApplications = ExemptionApplication::latest()->paginate(10);
    $declarations           = ExemptionDeclaration::latest()->paginate(10);
    $variations             = ExemptionVariation::latest()->paginate(10);
    $wagers                 = ExemptionWager::latest()->paginate(10);
    $users                  = User::latest()->paginate(5);
        $counts = [
            'application' => Continuous_Operation::count(),
            'exemptionsApplications' => ExemptionApplication::count(),
            'declarations'           => ExemptionDeclaration::count(),
            'variations'             => ExemptionVariation::count(),
            'wagers'                 => ExemptionWager::count(),
            'users'                  => User::count(),
        ];

        return view('dashboard', compact(
            'exemptionsApplications',
            'declarations',
            'variations',
            'wagers',
            'users',
            'counts'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

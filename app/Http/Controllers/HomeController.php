<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExemptionWager;
use App\Models\ExemptionApplication;
use App\Models\ExemptionDeclaration;
use App\Models\Exemption_Variation;
use App\Models\Continuous_operation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
         // Paginated data for tables (per page)
     $application = Continuous_Operation::latest()->paginate(10);
    $exemptionsApplications = ExemptionApplication::latest()->paginate(10);
    $declarations           = ExemptionDeclaration::latest()->paginate(10);
    $variations             = Exemption_Variation::latest()->paginate(10);
    $wagers                 = ExemptionWager::latest()->paginate(10);
    $users                  = User::latest()->paginate(5);
        $counts = [
            'application' => Continuous_Operation::count(),
            'exemptionsApplications' => ExemptionApplication::count(),
            'declarations'           => ExemptionDeclaration::count(),
            'variations'             => Exemption_Variation::count(),
            'wagers'                 => ExemptionWager::count(),
            'users'                  => User::count(),
        ];

        return view('home', compact(
            'exemptionsApplications',
            'declarations',
            'variations',
            'wagers',
            'users',
            'counts'
        ));
    }
}

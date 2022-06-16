<?php

namespace App\Http\Controllers;
use App\Users;
use App\Newsletter;
use App\Feedback;
use App\UserType;
use App\HouseCost;
use App\Construction;
use App\Plot;
use App\AllotteeParticular;
use App\Payment;
use App\Constructor;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

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
        $checkactive = DB::table('users')->where('email', Auth::user()->email)->first();
        if(isset($checkactive) AND Auth::user()->hasRole->role !='Admin' AND $checkactive->is_active == 0) {
            Auth::logout();
            Session::flush();
            Session::flash('record_exists', 'Sorry! You can not login wait for approval.');
            return redirect('login');
        }

        $cnr = new Controller;

        if(Auth::user()->hasRole->role=='Admin'){
            $total_built_houses = DB::table('construction')
            ->join('plots', 'plots.id', '=', 'construction.plot_id')
            ->where('assign_plot', 0)
            ->where('status', 'completed')
            ->count();

            $total_progress_houses = Construction::where('status', 'progress')->count();
            $total_plots = Plot::count();

            $total_users = Users::where('is_active', 1)->where('role', '!=', 2)->count();

            $total_active_members = DB::table('allottee_particulars')
            ->join('payment', 'payment.p_no', '=', 'allottee_particulars.p_no')
            ->where('is_active', 1)
            ->count();

            $total_members = AllotteeParticular::count();
            $members_total_amount = Payment::sum('submitted_amount');
            $members_total_amount = $cnr->gettypenumber($members_total_amount);

            $total_contractors = Constructor::count();

            $total_alloted_houses  = DB::table('construction')
            ->join('plots', 'plots.id', '=', 'construction.plot_id')
            ->where('assign_plot', 1)
            ->where('status', 'completed')
            ->count();

            $total_letters = Newsletter::count();
            $total_feedbacks = Feedback::count();
            
            return view('home.index', compact('total_built_houses', 'total_progress_houses', 'total_plots', 'total_users', 'total_active_members', 'total_members', 'members_total_amount', 'total_contractors', 'total_alloted_houses', 'total_letters', 'total_feedbacks'));
        }else{
            $members_total_amount = Payment::where('p_no', Auth::user()->p_no)->sum('submitted_amount');
            $members_total_amount = $cnr->gettypenumber($members_total_amount);
            $payment_ledger = Payment::orderby('id', 'DESC')->where('p_no', Auth::user()->p_no)->first(['is_active']);
            return view('home.index', compact('members_total_amount', 'payment_ledger'));
        }        
    }

    public function ShopIndex(){
    }
}

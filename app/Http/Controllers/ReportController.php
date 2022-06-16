<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propertytype;
use Session;
use Illuminate\Support\Facades\Input;
use App\AllotteeParticular;
use App\HouseCost;
use App\MemberProfit;
use App\Rank;
use App\Payment;
use App\PromotedMember;
use DateTime;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new Propertytype;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Propertytype::Search();
        }else{
           $models =  Propertytype::paginate(50);
        }
        
                
        if (\Request::ajax()) {

            return view('propertytype.ajax',  compact('models'));
        }

    	
        return view('propertytype.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('propertytype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Propertytype::getValidationRules());

        $input = $request->all();
	    Propertytype::create($input);

	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        $model = Propertytype::findOrFail($id);
        
      	return view('propertytype.show', array('model' => $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
         $model = Propertytype::findOrFail($id);

    return view('propertytype.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //
       $model = Propertytype::findOrFail($id);

	    $this->validate($request, Propertytype::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Propertytype successfully updated!');

	    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $model = Propertytype::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Propertytype successfully deleted!');

	    return redirect()->route('propertytype.index');
    }



    /**
     * Generate General Report
     **/

    public function generalReport(){

        print_r($_REQUEST);
        return view('reports.general');
    }

    /**
     * Generate Membership Report
     **/
    public function membershipReport(){

    print_r($_REQUEST);
        return view('reports.membership');
    }


    /**
     * Generate Allotment Report
     **/
    public function allotmentReport(Request $request){
        print_r($request);
        //return view('reports.allotment');
    }
    
    public function memberFinancialReport(Request $request)
    {
        if(isset($_GET['submit'])){
            $record = PromotedMember::orderby('id', 'DESC')->where('new_p_no', $request->p_no)->orWhere('promoted_rank_id', $request->rank)->first();
            $members = '';
            if(empty($record)){
                $query = AllotteeParticular::where('id','>',0);
                if(!empty($request->p_no)){
                    $query->where("p_no","=", $request->p_no);
                }
                if(!empty($request->name)){
                    $query->where("name","=", $request->name);
                }

                if(!empty($request->rank)){
                    $query->where("rank_rate","=", $request->rank);
                }
                if($request->status==1 OR $request->status==0){
                    $query->where("status","=", $request->status);
                }
                $members = $query->paginate(10);
            }else{
                $query = AllotteeParticular::where('id','>',0);
                if(!empty($request->p_no)){
                    $query->where("p_no","=", $record->old_p_no);
                }
                if(!empty($request->rank)){
                    $query->where("rank_rate","=", $record->promoted_rank_id);
                }
                $members = $query->paginate(10);
            }
        }else{
            $members = AllotteeParticular::with('hasAllotedHouse')->orderby('id', 'DESC')->paginate(10);
        }

        $available_house = HouseCost::orderby('id', 'DESC')->first();
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('reports.member-financial-report', compact('members', 'available_house', 'ranks'));
    }

    public function projectFinancialReport()
    {
        $members = AllotteeParticular::orderby('id', 'DESC')->paginate(10);
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('reports.project-financial-report', compact('members', 'ranks'));
    }

    public function eligibilityReport(Request $request)
    {
        if(isset($_GET['submit'])){
            $record = PromotedMember::orderby('id', 'DESC')->where('new_p_no', $request->p_no)->orWhere('promoted_rank_id', $request->rank)->first();
            $members = '';
            if(!$record){
                $query = AllotteeParticular::where('id','>',0);
                if(!empty($request->p_no)){
                    $query->where("p_no","=", $request->p_no);
                }
                if(!empty($request->name)){
                    $query->where("name","=", $request->name);
                }
                if(!empty($request->rank)){
                    $query->where("rank_rate","=", $request->rank);
                }
                if($request->status==1 OR $request->status==0){
                    $query->where("status","=", $request->status);
                }
                $members = $query->paginate(10);
            }else{
                $query = AllotteeParticular::where('id','>',0);
                if(!empty($record->old_p_no)){
                    $query->where("p_no","=", $record->old_p_no);
                }
                if(!empty($record->promoted_rank_id)){
                    $query->where("rank_rate","=", $record->promoted_rank_id);
                }
                $members = $query->paginate(10);
            }
        }else{
            $members = AllotteeParticular::with('hasAllotedHouse')->orderby('id', 'DESC')->paginate(10);
        }
        $available_house = HouseCost::orderby('id', 'DESC')->first();
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('reports.eligibility-report', compact('members', 'available_house', 'ranks'));
    }

    public function profitStatementReport()
    {
        $members = AllotteeParticular::orderby('id', 'DESC')->paginate(10);
        $available_house = HouseCost::orderby('id', 'DESC')->first();
        $profit_rate = MemberProfit::orderby('id', 'DESC')->first();
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('reports.profit-statement-report', compact('members', 'available_house', 'profit_rate', 'ranks'));
    }

    public function search(Request $request)
    {
        $available_house = HouseCost::orderby('id', 'DESC')->first();
        $profit_rate = MemberProfit::orderby('id', 'DESC')->first();
        $ranks = Rank::where('status', 1)->pluck('name', 'id');

        if($request->report == 'member_financial_report'){
            $membership_service = '';
            $service = '';
            $status = '';
            if(!empty($request->p_no)){
                $members = AllotteeParticular::where('p_no', $request->p_no)->paginate(10);
            }else if(!empty($request->name)){
                $members = AllotteeParticular::where('name', $request->name)->paginate(10);
            }else if(!empty($request->rank)){
                $members = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
            }else if(!empty($request->eligibility)){
                if($request->eligibility=='seventy_per_amount'){
                    $all_members = AllotteeParticular::where('plotassigned', 0)->get();
                    $total_members = [];
                    foreach($all_members as $member){
                        $paid_amount = Payment::where('p_no', $member->p_no)->sum('sub_monthly_install');
                        $house_cost = $available_house->initial_cost;
                        $house_percent = $paid_amount/$house_cost*100;
                        if($house_percent>=70){
                            $total_members[] = $member->p_no;
                        }
                    }
    
                    $members = AllotteeParticular::whereIn('p_no', $total_members)->paginate(10);
    
                }elseif($request->eligibility=='three_years_membership'){
                    $members = AllotteeParticular::where('plotassigned', 0)->paginate(10);
                    $membership_service = $request->eligibility;
    
                }elseif($request->eligibility=='twenty_three_years_service'){
                    $members = AllotteeParticular::where('plotassigned', 0)->paginate(10);
                    $service = $request->eligibility;
                }
            }else if($request->status=='0' || $request->status=='1'){
                $members = AllotteeParticular::paginate(10);
                $status = $request->status;
            }else{
                return back();
            }

            return view('reports.member-financial-report', compact('members', 'available_house', 'profit_rate', 'ranks', 'membership_service', 'service', 'status'));
        }elseif($request->report == 'project_financial_report'){
            $allocated_account_of = '';
            $house_no = '';
            if(!empty($request->p_no)){
                $members = AllotteeParticular::where('p_no', $request->p_no)->paginate(10);
            }else if(!empty($request->name)){
                $members = AllotteeParticular::where('name', $request->name)->paginate(10);
            }else if(!empty($request->rank)){
                $members = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
            }else if(!empty($request->account_of)){
                $allocated_account_of = $request->account_of;
                $members = AllotteeParticular::paginate(10);
            }else if(!empty($request->house_no)){
                $house_no = $request->house_no;
                $members = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
            }else{
                return back();
            }

            return view('reports.project-financial-report', compact('members', 'available_house', 'profit_rate', 'ranks', 'allocated_account_of', 'house_no'));
        }elseif($request->report == 'eligibility_report'){
            if(!empty($request->p_no)){
                $members = AllotteeParticular::where('p_no', $request->p_no)->paginate(10);
            }else if(!empty($request->name)){
                $members = AllotteeParticular::where('name', $request->name)->paginate(10);
            }else if(!empty($request->rank)){
                $members = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
            }else{
                return back();
            }

            return view('reports.eligibility-report', compact('members', 'available_house', 'profit_rate', 'ranks'));
        }elseif($request->report == 'profit_statement_report'){
            $membership_service = '';
            $service = '';
            $status = '';
            if(!empty($request->p_no)){
                $members = AllotteeParticular::where('p_no', $request->p_no)->paginate(10);
            }else if(!empty($request->name)){
                $members = AllotteeParticular::where('name', $request->name)->paginate(10);
            }else if(!empty($request->rank)){
                $members = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
            }else if(!empty($request->eligibility)){
                if($request->eligibility=='seventy_per_amount'){
                    $all_members = AllotteeParticular::where('plotassigned', 0)->get(['p_no']);
                    $total_members = [];
                    foreach($all_members as $member){
                        $paid_amount = Payment::where('p_no', $member->p_no)->sum('sub_monthly_install');
                        $house_cost = $available_house->initial_cost;
                        $house_percent = $paid_amount/$house_cost*100;
                        if($house_percent>=70){
                            $total_members[] = $member->p_no;
                        }
                    }
    
                    $members = AllotteeParticular::whereIn('p_no', $total_members)->paginate(10);
    
                }elseif($request->eligibility=='three_years_membership'){
                    $members = AllotteeParticular::where('plotassigned', 0)->paginate(10);
                    $membership_service = $request->eligibility;
    
                }elseif($request->eligibility=='twenty_three_years_service'){
                    $members = AllotteeParticular::where('plotassigned', 0)->paginate(10);
                    $service = $request->eligibility;
                }
            }else if($request->status=='0' || $request->status=='1'){
                $members = AllotteeParticular::paginate(10);
                $status = $request->status;
            }else{
                return back();
            }

            return view('reports.profit-statement-report', compact('members', 'available_house', 'profit_rate', 'ranks', 'membership_service', 'service', 'status'));
        }
    }

    public function searchMembershipMembers(Request $request)
    {
        $status = '';
        if(!empty($request->p_no)){
            $models = AllotteeParticular::where('p_no', $request->p_no)->paginate(10);
        }else if(!empty($request->name)){
            $models = AllotteeParticular::where('name', $request->name)->paginate(10);
        }else if(!empty($request->rank)){
            $models = AllotteeParticular::where('rank_rate', $request->rank)->paginate(10);
        }else if($request->status=='0' || $request->status=='1'){
            $models = AllotteeParticular::paginate(10);
            $status = $request->status;
        }else{
            return back();
        }

        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('allotteeDetailsOfKin.index', compact('models', 'ranks', 'status'));
    }
}
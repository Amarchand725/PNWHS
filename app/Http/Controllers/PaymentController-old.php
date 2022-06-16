<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\AllotteeParticular;
use App\Construction;
use App\Plot;
use App\AllotedHouse;
use Auth;
use App\MemberProfit;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new Payment;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Payment::Search();
        }else{
            if(Auth::user()->userType->name == 'admin'){
                $models = Payment::orderby('id', 'DESC')->groupBy('p_no')
                ->selectRaw('*, sum(sub_monthly_install) as total_instalments_amount')
                ->orderby('id', 'DESC')
                ->paginate(10);
            }elseif(Auth::user()->userType->name == 'user'){
                $models = Payment::orderby('id', 'DESC')->where('p_no', Auth::user()->p_no)->paginate(10);
                $acc =  Db::table('contacts')->where('p_no', Auth::user()->p_no)->get();
                return view('payment.ledger', compact('models', 'acc'));
            }
        }
        if (\Request::ajax()) {
            return view('payment.ajax',  compact('models'));
        }

        return view('payment.index', compact('models', 'formModel'));
    }

    //Show Payment Data
    public function paymentlisting(){
        $models = Payment::paginate(20);
       return view('payment.listing',compact('models'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if(isset($request->status) AND $request->status=='searched'){
            $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $request->p_no)->first();
            if(!empty($member_details)){
                $member_payment = Payment::where('p_no', $request->p_no)->orderby('id', 'DESC')->first();
                $paid_amount = 0;
                $total_installs_amount = 0;
                if(!empty($member_payment)){
                    if($member_payment->is_active==0){
                        $paid_amount = Payment::where('p_no', $request->p_no)->where('is_active', 0)->sum('submitted_amount');
                    }else{
                        $active_from = Payment::where('p_no', $request->p_no)->where('is_active', 1)->first();
                        $m_active_from = strtotime($active_from->created_at);
                        $current = strtotime(now());

                        $active_year = date('Y', $m_active_from);
                        $current_year = date('Y', $current);

                        $active_month = date('m', $m_active_from);
                        $current_month = date('m', $current);

                        $total_active_months = (($current_year - $active_year) * 12) + ($current_month - $active_month);
                        $total_active_months_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment*$total_active_months;
                        $paid_amount = Payment::where('p_no', $request->p_no)->where('is_active', 1)->sum('sub_monthly_install');
                        $total_installs_amount = $paid_amount-$total_active_months_amount;
                    }
                }
                return view('payment.create', compact('member_details', 'member_payment', 'paid_amount', 'total_installs_amount'));
            }else{
                Session::flash('record_exists', 'Sorry! No Found Record');
                return back();
            }
        }else{
            $this->validate($request, Payment::getValidationRules());
            $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $request->p_no)->first();
            $member_payment = Payment::where('p_no', $request->p_no)->orderby('id', 'DESC')->first();

            if(empty($member_payment)){
                $total_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment+$member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment;  
                
                if($request->submit_amount<$total_amount){
                    $amount = $request->submit_amount-$total_amount;
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'payment_type' => $request->payment_type,
                        'total_amount' => $total_amount,
                        'submitted_amount' => $request->submit_amount,
                        'amount' => $amount,
                        'bank_name' => $request->bank_name,
                        'deposit_date' => $request->deposit_date,
                        'instrument_no' => $request->instrument_no,
                        'remarks' => $request->remarks,
                    ]);
                }else if($request->submit_amount==$total_amount){
                    $amount = $request->submit_amount-$total_amount;
                    $monthly_install = $amount-$member_details->hasRank->has_policy->has_payment_policy->monthly_instalment;
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'payment_type' => $request->payment_type,
                        'total_amount' => $total_amount,
                        'submitted_amount' => $request->submit_amount,
                        'amount' => $amount,
                        'bank_name' => $request->bank_name,
                        'deposit_date' => $request->deposit_date,
                        'instrument_no' => $request->instrument_no,
                        'remarks' => $request->remarks,
                    ]);
                    
                    //Create user active
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'total_amount' => $monthly_install,
                        'submitted_amount' => $request->submit_amount,
                        'sub_monthly_install' => $amount,
                        'amount' => $amount-$monthly_install,
                        'is_active' => 1,
                    ]);
                }else{
                    $amount = $request->submit_amount-$total_amount;
                    $monthly_install = $member_details->hasRank->has_policy->has_payment_policy->monthly_instalment;
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'payment_type' => $request->payment_type,
                        'total_amount' => 0,
                        'submitted_amount' => $total_amount,
                        'amount' => 0,
                        'bank_name' => $request->bank_name,
                        'deposit_date' => $request->deposit_date,
                        'instrument_no' => $request->instrument_no,
                        'remarks' => $request->remarks,
                    ]);

                    //Create User Active
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'payment_type' => $request->payment_type,
                        'total_amount' => $monthly_install,
                        'sub_monthly_install' => $amount,
                        'amount' => $amount-$monthly_install,
                        'bank_name' => $request->bank_name,
                        'deposit_date' => $request->deposit_date,
                        'instrument_no' => $request->instrument_no,
                        'remarks' => $request->remarks,
                        'is_active' => 1,
                    ]);
                }
            }elseif($member_details->plotassigned==1){
                Payment::create([
                    'p_no' => $request->p_no,
                    'member_id' => $member_details->id,
                    'payment_type' => $request->payment_type,
                    'total_amount' => $last_amount,
                    'sub_monthly_install' => $request->submit_amount,
                    'amount' => $amount,
                    'bank_name' => $request->bank_name,
                    'deposit_date' => $request->deposit_date,
                    'instrument_no' => $request->instrument_no,
                    'remarks' => $request->remarks,
                    'is_active' => 1,
                ]);
            }else{
                if($member_payment->is_active==0){
                    if($request->submit_amount < abs($member_payment->amount)){
                        $amount = $request->submit_amount+$member_payment->amount;
                        Payment::create([
                            'p_no' => $request->p_no,
                            'member_id' => $member_details->id,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $member_payment->amount,
                            'submitted_amount' => $request->submit_amount,
                            'amount' => $amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                        ]);
                    }else if($request->submit_amount == abs($member_payment->amount)){
                        $amount = $request->submit_amount+$member_payment->amount;
                        $monthly_install = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment;
                        Payment::create([
                            'p_no' => $request->p_no,
                            'member_id' => $member_details->id,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $member_payment->amount,
                            'submitted_amount' => $request->submit_amount,
                            'amount' => $amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                        ]);

                        //Create user active
                        Payment::create([
                            'p_no' => $request->p_no,
                            'member_id' => $member_details->id,
                            'total_amount' => $monthly_install,
                            'sub_monthly_install' => $amount,
                            'amount' => $amount-$monthly_install,
                            'is_active' => 1,
                        ]);
                    }else if($request->submit_amount > abs($member_payment->amount)){
                        $amount = $request->submit_amount+$member_payment->amount;
                        $monthly_install = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment;

                        Payment::create([
                            'p_no' => $request->p_no,
                            'member_id' => $member_details->id,
                            'payment_type' => $request->payment_type,
                            'total_amount' => 0,
                            'submitted_amount' => abs($member_payment->amount),
                            'amount' => 0,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                        ]);

                        //Create User Active
                        Payment::create([
                            'p_no' => $request->p_no,
                            'member_id' => $member_details->id,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $monthly_install,
                            'sub_monthly_install' => $amount,
                            'submitted_amount' => $amount,
                            'amount' => $amount-$monthly_install,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                            'is_active' => 1,
                        ]);
                    }
                }else if($member_payment->is_active==1){
                    $active_from = Payment::where('p_no', $request->p_no)->where('is_active', 1)->first();
                    $m_active_from = strtotime($active_from->created_at);
                    $current = strtotime(now());

                    $active_year = date('Y', $m_active_from);
                    $current_year = date('Y', $current);

                    $active_month = date('m', $m_active_from);
                    $current_month = date('m', $current);

                    $total_active_months = (($current_year - $active_year) * 12) + ($current_month - $active_month);
                    $total_active_months_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment*$total_active_months;
                    $total_paid_installs = Payment::where('p_no', $request->p_no)->where('is_active', 1)->sum('sub_monthly_install');
                    $last_amount = $total_paid_installs-$total_active_months_amount;
                    $amount = $request->submit_amount+$last_amount;

                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member_details->id,
                        'payment_type' => $request->payment_type,
                        'total_amount' => $last_amount,
                        'sub_monthly_install' => $request->submit_amount,
                        'amount' => $amount,
                        'bank_name' => $request->bank_name,
                        'deposit_date' => $request->deposit_date,
                        'instrument_no' => $request->instrument_no,
                        'remarks' => $request->remarks,
                        'is_active' => 1,
                    ]);
                }
            }

            Session::flash('flash_message', 'Task successfully added!');
            return redirect()->back();
        }
    }

    public function allocateHouse($id)
    {
        $p_no = $id;
        $houses = Plot::with('hasConstruction')->get();

        $member = AllotteeParticular::with('hasRank')->where('p_no', $p_no)->first();
        $houses =DB::table('plots')
                ->join('construction','plots.id', '=', 'construction.plot_id')
                ->where('category', $member->hasRank->category)
                ->where('assign_plot', 0)
                ->get();
        return view('payment.house-allocate', compact('houses', 'p_no'));
    }

    public function getHouseDetails(Request $request)
    {
        $house_total_amount = 0;
        $allocated_on_account_of = '';
        if($request->allocate=='House Percent'){
            $paid_amount = Payment::where('p_no', $request->p_no)->where('is_active', 1)->sum('sub_monthly_install');
            $house = Plot::where('id', $request->house_id)->first();
            $house_total_amount = $house->amount+$house->hasConstruction->initial_price;
            $allocated_on_account_of = $request->allocate;
        }elseif($request->allocate=='Shaheed' OR $request->allocate=='Medical'){
            $allocated_on_account_of = $request->allocate;
            $paid_amount = Payment::where('p_no', $request->p_no)->where('is_active', 1)->sum('sub_monthly_install');
        }
        return response()->json(['paid_amount' => $paid_amount, 'house_amount' => $house_total_amount, 'allocated_on_acc_of' => $allocated_on_account_of]);
    }

    public function allocatedHouse(Request $request)
    {
        $this->validate($request, AllotedHouse::getValidationRules());
        if($request->allocated_account_of=='House Percent'){
            $alloted = AllotedHouse::create([
                'p_no' => $request->p_no,
                'allocated_house' => $request->allocated_house,
                'allocated_account_of' => $request->allocated_account_of,
                'house_dues_instalment' => $request->house_dues_instalment,
                'created_by' => Auth::User()->id,
            ]);
        }elseif($request->allocated_account_of=='Shaheed' || $request->allocated_account_of=='Medical'){
            $alloted = AllotedHouse::create([
                'p_no' => $request->p_no,
                'allocated_house' => $request->allocated_house,
                'allocated_account_of' => $request->allocated_account_of,
                'house_dues_instalment' => 0,
                'created_by' => Auth::User()->id,
            ]);
        }
        if($alloted){
            $member = AllotteeParticular::findOrFail($request->p_no);
            $member->plotassigned=1;
            $member->save();

            $house = Plot::findOrFail($request->allocated_house);
            $house->assign_plot=1;
            $house->save();

            $member_paid = Payment::where('p_no', $request->p_no)->where('is_active', 1)->orderby('id', 'DESC')->sum('sub_monthly_install');
            
            if($request->allocated_account_of=='House Percent'){
                $house_price = $house->amount+$house->hasConstruction->initial_price;
                $dues_house_price = $member_paid-$house_price;

                if($member_paid==$house_price){
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member->id,
                        'plot_no' => $request->allocated_house,
                        'total_amount' => $house_price,
                        'sub_monthly_install' => 0,
                        'amount' => $dues_house_price,
                        'payment_status' => 0,
                        'is_active' => 1,
                    ]);
                }else{
                    Payment::create([
                        'p_no' => $request->p_no,
                        'member_id' => $member->id,
                        'plot_no' => $request->allocated_house,
                        'total_amount' => $house_price,
                        'sub_monthly_install' => 0,
                        'amount' => $dues_house_price,
                        'payment_status' => 1,
                        'is_active' => 1,
                    ]);
                }
            }elseif($request->allocated_account_of=='Shaheed' || $request->allocated_account_of=='Medical'){
                Payment::create([
                    'p_no' => $request->p_no,
                    'member_id' => $member->id,
                    'plot_no' => $request->allocated_house,
                    'total_amount' => 0,
                    'sub_monthly_install' => 0,
                    'amount' => 0,
                    'payment_status' => 0,
                    'is_active' => 1,
                ]);
            }
        }
        return redirect('AllotedHouse');
    }
    
    public function getProfit(Request $request)
    {   
        $profit = MemberProfit::orderby('id', 'DESC')->first();
        $paid_amount = Payment::where('p_no', $request->p_no)->sum('sub_monthly_install');
        return response()->json(['profit' => $profit, 'paid_amount' => $paid_amount]);

    }

    //Leger Function
    public function Ledger($id)
    {
        $models = Payment::orderby('id', 'DESC')->where('p_no', $id)->paginate(10);
        $acc =  Db::table('contacts')->where('p_no',$id)->get();
        return view('payment.ledger', compact('models', 'acc'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $model = Payment::findOrFail($id);
      	return view('payment.show', array('model' => $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $model = Payment::findOrFail($id);
        return view('payment.edit')->withModel($model);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    //Monthly Installment
    public function installment($id){
        $member_id = $id;
        $registeruser =  DB::table('assignplot')->where('member_id',$id)->orderBy('id','desc')->first();
        $allotee_data =  DB::table('allottee_particulars')->where('id',$id)->orderBy('id','desc')->first();
        $pno = $allotee_data->p_no;
        return view('payment.installment',compact('member_id','registeruser','pno'));
    }

    public function update($id, Request $request)
    {
        //
       $model = Payment::findOrFail($id);
	    $this->validate($request, Payment::getValidationRules());
	    $model->fill($request->all())->save();
	    Session::flash('flash_message', 'Payment successfully updated!');
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
        $model = Payment::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Payment successfully deleted!');

	    return redirect()->route('payment.index');
    }
}

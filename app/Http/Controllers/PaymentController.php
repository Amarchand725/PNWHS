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
use App\PromotedMember;
use App\GetProfit;
use App\AssignedPolicy;
use App\PaymentPolicy;
use App\PaymentPolicyData;
use App\payableRegInsurance;

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
            $ifexist = PromotedMember::where('new_p_no', Input::get("p_no"))->first();
            if(!empty($ifexist)){
                $models = Payment::where('p_no', $ifexist->old_p_no)
                ->selectRaw('*, sum(sub_monthly_install) as total_instalments_amount')
                ->paginate(10);
            }else{
                $models = Payment::where('p_no', Input::get("p_no"))
                ->selectRaw('*, sum(sub_monthly_install) as total_instalments_amount')
                ->paginate(10);
            }
        }else{
            if(Auth::user()->userType->name == 'admin'){
                $models = Payment::orderby('id', 'DESC')->groupBy('member_id')
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
        $output = [];
        $monthly_payments = [];
        $last   = date('Y-m', strtotime(now()));

        if(isset($request->status) AND $request->status=='searched'){
            $ifexist = PromotedMember::orderby('id', 'DESC')->where('old_p_no', $request->p_no)->orWhere('new_p_no', $request->p_no)->first();
            // dd($ifexist);
            if(!empty($ifexist)){
                $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $ifexist->old_p_no)->orwhere('p_no', $ifexist->new_p_no)->first();
            }else{
                $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $request->p_no)->first();
            }

            if(!empty($member_details)){
                // dd($member_details);
                if($member_details->payment_status==1){
                    //Suleman
                    $time   = strtotime($member_details->active_date);
            
                    do {
                        $month = date('Y-m', $time);
                        $output[$month] = "asd";

                        $time = strtotime('+1 month', $time);
                    } while ($month != $last);

                    foreach($output as $m=>$k){
                        $m = $m."-31";
                        $e = PromotedMember::where('member_id', $member_details->id)->whereDate('d_o_p', '<=', $m)->orderby('d_o_p', 'DESC')->first();

                        $relevantPolicy =  PaymentPolicyData::with('hasPaymentPolicy')
                            ->where('rank_id',$e->promoted_rank_id)
                            ->whereDate('effective_date', '<=', $m)
                            ->where(function ($query) use ($m){
                            $query->whereDate('expire_date', '>=', $m)
                                ->orWhereNull('expire_date');
                        })->First();

                        $monthly_payments[$m] = $relevantPolicy->hasPaymentPolicy->monthly_instalment;
                    }

                    $monthlyTotalamountProcude = array_sum($monthly_payments);
                    //Suleman

                    $emp_info = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                    $last_promotion = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    $current_monthly_policy = PaymentPolicyData::with('hasPaymentPolicy')->where('rank_id', $last_promotion->promoted_rank_id)->first();
                    
                    $reg_insurance_total_payable = payableRegInsurance::where('member_id', $member_details->id)->sum('payable_amount');
                    $reg_insurance_total_paid = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                    
                    $total_monthly_paid = Payment::where('member_id', $member_details->id)->sum('sub_monthly_install');
                    $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    
                    $reg_insurance_difference = $reg_insurance_total_paid - $reg_insurance_total_payable;
                    $total_dues = $reg_insurance_difference-$monthlyTotalamountProcude;
                    if($total_dues<0){
                        $total_payabale = $total_monthly_paid-abs($total_dues);
                        if($total_payabale<0){
                            $total_payabale = $total_monthly_paid-abs($total_dues);
                        }else{
                            $total_payabale = 0;
                        }
                    }else{
                        $total_payabale = 0;
                    }
                    
                    return view('payment.create', compact('member_details', 'policy', 'total_monthly_paid', 'last_trasaction', 'current_monthly_policy', 'total_monthly_paid', 'total_payabale'));
                }else{
                    $emp_info = PromotedMember::where('member_id', $member_details->id)->first();
                    $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                    $reg_insurance_total_paid = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                    $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    return view('payment.create', compact('member_details', 'policy', 'reg_insurance_total_paid', 'last_trasaction'));
                }
            }
            else{
                Session::flash('record_exists', 'Sorry! No Found Record');
                return back();
            }
        }else{
            $voucher_no = '';
            do {
                $voucher_no = mt_rand( 1000, 9999 );
            } while ( DB::table( 'payment' )->where( 'voucher_no', $voucher_no )->exists() );

            // $ifexist = PromotedMember::orderby('id', 'DESC')->where('old_p_no', $request->p_no)->orWhere('new_p_no', $request->p_no)->first();
            // if(!empty($ifexist)){
            $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $request->p_no)->first();
            // }else{
            //     $member_details = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $request->p_no)->first();
            // }

            if(!empty($member_details)){
                if($member_details->payment_status==1){
                    //Suleman
                    $time   = strtotime($member_details->active_date);
            
                    do {
                        $month = date('Y-m', $time);
                        $output[$month] = "asd";

                        $time = strtotime('+1 month', $time);
                    } while ($month != $last);

                    $reg_insurance = 0;
                    foreach($output as $m=>$k){
                        $m = $m."-31";
                        $e = PromotedMember::where('member_id', $member_details->id)->whereDate('d_o_p', '<=', $m)->orderby('d_o_p', 'DESC')->first();


                        $relevantPolicy =  PaymentPolicyData::with('hasPaymentPolicy')
                            ->where('rank_id',$e->promoted_rank_id)
                            ->whereDate('effective_date', '<=', $m)
                            ->where(function ($query) use ($m){
                            $query->whereDate('expire_date', '>=', $m)
                                ->orWhereNull('expire_date');
                        })->First();

                        $monthly_payments[$m] = $relevantPolicy->hasPaymentPolicy->monthly_instalment;
                    }

                    $monthlyTotalamountProcude = array_sum($monthly_payments);

                    // $balance = ($payableKarza +$monthlyTotalamountProcude) - $totalPAymentDone ;
                    //Suleman

                    $emp_info = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                    $last_promotion = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    $current_monthly_policy = PaymentPolicyData::with('hasPaymentPolicy')->where('rank_id', $last_promotion->promoted_rank_id)->first();
                    
                    $reg_insurance_total_payable = payableRegInsurance::where('member_id', $member_details->id)->sum('payable_amount');
                    $reg_insurance_total_paid = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                    
                    $total_monthly_paid = Payment::where('member_id', $member_details->id)->sum('sub_monthly_install');
                    $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();

                    $reg_insurance_difference = $reg_insurance_total_paid - $reg_insurance_total_payable;
                    $total_dues = $reg_insurance_difference-$monthlyTotalamountProcude;
                    if($total_dues<0){
                        $payabale = $total_monthly_paid-abs($total_dues);
                        if($payabale<0){
                            $payabale = $total_monthly_paid-abs($total_dues);
                        }else{
                            $payabale = 0;
                        }
                    }else{
                        $payabale = 0;
                    }

                    //checks if found insurance difference
                    if($reg_insurance_difference<0){
                        if($request->submit_amount>$reg_insurance_difference){
                            if($reg_insurance_difference<0){
                                $amount = $request->submit_amount-abs($reg_insurance_difference);
                            }
                            if($amount<0){
                                $reg_ins = $request->submit_amount;
                                $active = 1;
                                $monthly = 0;
                                $amount1 = 0;
                            }else if($amount==0){
                                $reg_ins = $request->submit_amount;
                                $active = 1;
                                $monthly = 0;
                                $amount1 = 0;
                            }else{
                                $amount1 = $request->submit_amount-abs($reg_insurance_difference);
                                $reg_ins = abs($reg_insurance_difference);
                                $monthly = $amount;
                                $active = 1;
                            }
                        }

                        $inserted = Payment::create([
                            'p_no' => $member_details->p_no,
                            'member_id' => $member_details->id,
                            'voucher_no' => $voucher_no,
                            'slip_no' => $request->slip_no,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $payabale,
                            'reg_insu_fee' => $reg_ins,
                            'sub_monthly_install' => $monthly??null,
                            'submitted_amount' => $last_trasaction->submitted_amount+$monthly,
                            'current_paid' => $request->submit_amount,
                            'amount' => $amount1 != 0?$amount1:$amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                            'is_active' => $active??0,
                        ]);    
                    }else{
                        $amount = $request->submit_amount-abs($payabale);
                        if($request->submit_amount>$payabale){
                            $monthly = $request->submit_amount;
                            $active = 1;
                        }
                        
                        $inserted = Payment::create([
                            'p_no' => $member_details->p_no,
                            'member_id' => $member_details->id, 
                            'voucher_no' => $voucher_no,
                            'slip_no' => $request->slip_no,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $payabale,
                            'sub_monthly_install' => $monthly??null,
                            'submitted_amount' => $last_trasaction->submitted_amount+$request->submit_amount,
                            'current_paid' => $request->submit_amount,
                            'amount' => $amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                            'is_active' => $active??0,
                        ]);
                    }
                }else{
                    // $emp_info = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    // $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                    // $paid_amount = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                    
                    // $payabale = $paid_amount-$policy->payable_amount;
                    // if($request->submit_amount>$payabale){
                    //     $amount = $request->submit_amount+$payabale;
                    //     if($amount<0){
                    //         $reg_ins = $request->submit_amount;
                    //         $monthly = 0;
                    //         if(!empty($last_trasaction->submitted_amount)){
                    //             $last_sub_amount = $last_trasaction->submitted_amount;
                    //         }else{
                    //             $last_sub_amount = 0;
                    //         }
                    //     }else if($amount==0){
                    //         $reg_ins = $request->submit_amount;
                    //         $monthly = 0;
                    //         $active = 1;
                    //         if(!empty($last_trasaction->submitted_amount)){
                    //             $last_sub_amount = $last_trasaction->submitted_amount;
                    //         }else{
                    //             $last_sub_amount = 0;
                    //         }
                    //     }else{
                    //         $reg_ins = abs($payabale);
                    //         $monthly = $amount;
                    //         $active = 1;    
                    //         if(!empty($last_trasaction->submitted_amount)){
                    //             $last_sub_amount = $last_trasaction->submitted_amount;
                    //         }else{
                    //             $last_sub_amount = 0;
                    //         }
                    //     }
                    // }

                    // $inserted = Payment::create([
                    //     'p_no' => $member_details->p_no,
                    //     'member_id' => $member_details->id,
                    //     'voucher_no' => $voucher_no,
                    //     'slip_no' => $request->slip_no,
                    //     'payment_type' => $request->payment_type,
                    //     'total_amount' => $payabale,
                    //     'reg_insu_fee' => $reg_ins,
                    //     'sub_monthly_install' => $monthly,
                    //     'submitted_amount' => $last_sub_amount+$monthly,
                    //     'current_paid' => $request->submit_amount,
                    //     'amount' => $amount,
                    //     'bank_name' => $request->bank_name,
                    //     'deposit_date' => $request->deposit_date,
                    //     'instrument_no' => $request->instrument_no,
                    //     'remarks' => $request->remarks,
                    //     'is_active' => $active??0,
                    // ]);
                    
                    // if($inserted->is_active==1){
                    //     $member_details->payment_status = 1;
                    //     $member_details->active_date = $inserted->created_at;
                    //     $member_details->update();
                    // }
                    
                    $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                    if(empty($last_trasaction)){
                        $emp_info = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                        $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                        $paid_amount = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                        
                        $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                        $payabale = $paid_amount-$policy->payable_amount;
                        if($request->submit_amount>$payabale){
                            $amount = $request->submit_amount+$payabale;
                            if($amount<0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else if($amount==0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                $active = 1;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else{
                                $reg_ins = abs($payabale);
                                $monthly = $amount;
                                $active = 1;    
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }
                        }

                        $inserted = Payment::create([
                            'p_no' => $member_details->p_no,
                            'member_id' => $member_details->id,
                            'voucher_no' => $voucher_no,
                            'slip_no' => $request->slip_no,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $payabale,
                            'reg_insu_fee' => $reg_ins,
                            'sub_monthly_install' => $monthly,
                            'submitted_amount' => $last_sub_amount+$monthly,
                            'current_paid' => $request->submit_amount,
                            'amount' => $amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                            'is_active' => $active??0,
                        ]);
                        
                        if($inserted->is_active==1){
                            $member_details->payment_status = 1;
                            $member_details->active_date = $inserted->created_at;
                            $member_details->update();
                        }
                    }else{
                        $emp_info = PromotedMember::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                        $policy = payableRegInsurance::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('promoted_id', $emp_info->id)->first();
                        $paid_amount = Payment::where('member_id', $member_details->id)->sum('reg_insu_fee');
                        
                        $last_trasaction = Payment::orderby('id', 'DESC')->where('member_id', $member_details->id)->first();
                        $payabale = $paid_amount-$policy->payable_amount;
                        if($request->submit_amount>$payabale){
                            $amount = $request->submit_amount+$payabale;
                            if($amount<0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else if($amount==0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                $active = 1;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else{
                                $reg_ins = abs($payabale);
                                $monthly = $amount;
                                $active = 1;    
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }
                        }else{
                            $amount = $request->submit_amount-$payabale;
                            if($amount<0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else if($amount==0){
                                $reg_ins = $request->submit_amount;
                                $monthly = 0;
                                $active = 1;
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }else{
                                $reg_ins = abs($payabale);
                                $monthly = $amount;
                                $active = 1;    
                                if(!empty($last_trasaction->submitted_amount)){
                                    $last_sub_amount = $last_trasaction->submitted_amount;
                                }else{
                                    $last_sub_amount = 0;
                                }
                            }
                        }

                        $inserted = Payment::create([
                            'p_no' => $member_details->p_no,
                            'member_id' => $member_details->id,
                            'voucher_no' => $voucher_no,
                            'slip_no' => $request->slip_no,
                            'payment_type' => $request->payment_type,
                            'total_amount' => $payabale,
                            'reg_insu_fee' => $reg_ins,
                            'sub_monthly_install' => $monthly,
                            'submitted_amount' => $last_sub_amount+$monthly,
                            'current_paid' => $request->submit_amount,
                            'amount' => $amount,
                            'bank_name' => $request->bank_name,
                            'deposit_date' => $request->deposit_date,
                            'instrument_no' => $request->instrument_no,
                            'remarks' => $request->remarks,
                            'is_active' => $active??0,
                        ]);
                        
                        if($inserted->is_active==1){
                            $member_details->payment_status = 1;
                            $member_details->active_date = $inserted->created_at;
                            $member_details->update();
                        }
                    }
                }
            }
            else{
                Session::flash('record_exists', 'Sorry! No Found Record');
                return back();
            }

            Session::flash('flash_message', 'Task successfully added!');
            return redirect()->back();
        }
    }

    public function allocateHouse($id)
    {
        $p_no = $id;
        $member = AllotteeParticular::with('hasRank')->where('p_no', $p_no)->first();
        $category = '';
        if(!empty($member->hasPromotedMember)){
            $category = $member->hasPromotedMember->hasPromotedRank->category;
        }else{
            $category = $member->hasRank->category;
        }
        $houses = DB::table('plots')
                ->join('construction','plots.id', '=', 'construction.plot_id')
                ->where('category', $category)
                ->where('assign_plot', 0)
                ->get();

        return view('payment.house-allocate', compact('houses', 'p_no'));
    }

    // public function paymentRefund()
    // {
    //     //where('got_fund', '!=', '')->
    //     $models = Payment::groupBy('p_no')
    //             ->selectRaw('*, sum(sub_monthly_install) as total_instalments_amount')
    //             ->orderby('id', 'DESC')
    //             ->paginate(10);
    //     return view('payment.refunds', compact('models'));
    // }

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
        if($request->allocated_account_of=='House Percent'){
            $this->validate($request, AllotedHouse::getValidationRules());
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

            $profit_rate = MemberProfit::orderby('id', 'DESC')->first;
            $paid_amount = Payment::where('p_no', $request->p_no)->where('is_active', 1)->sum('sub_monthly_install');
            $profit_amount = $paid_amount*$profit_rate/100;

            GetProfit::create([
                'profit_rate_id' => $profit_rate->id,
                'p_no' => $request->p_no,
                'account_of' => $request->allocated_account_of,
                'paid_amount' => $paid_amount,
                'profit_amount' => $profit_amount,
                'total_amount' => $paid_amount+$profit_amount,
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
        // $acc =  Db::table('contacts')->where('p_no',$id)->get();
        // // $ifexist = PromotedMember::where('new_p_no', $id)->orwhere()->first();
        // $ifexist = PromotedMember::orderby('id', 'DESC')->where('old_p_no', $id)->orWhere('new_p_no', $id)->first();
        // if($ifexist){
        //     $member_info = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no',$ifexist->old_p_no)->first();
        // }else{
        //     $member_info = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no',$id)->first();
        // }
        
        $member_info = AllotteeParticular::orderby('id', 'DESC')->where('id', $id)->first();
        $acc =  Db::table('contacts')->where('p_no',$member_info->original_p_no)->get();

        $models = Payment::where('member_id', $member_info->id)->paginate(10);
        $member_status = Payment::where('is_active', 1)->where('member_id', $member_info->id)->first();

        return view('payment.ledger', compact('models', 'acc', 'member_info'));
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

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromotedMember;
use App\PaymentPolicy;
use App\AssignedPolicy;
use App\Rank;
use App\AllotteeParticular;
use App\PaymentPolicyData;
use App\payableRegInsurance;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;

class PromotedMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $formModel = new PromotedMember;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = PromotedMember::Search();
        }else{
           $models =  PromotedMember::orderby('id', 'DESC')->paginate(10);
        }


        if (\Request::ajax()) {

            return view('promotedMember.ajax',  compact('models'));
        }


        return view('promotedMember.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('promotedMember.create', compact('ranks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // return $request->d_o_p;
        //
        $rules1 = [
            'promoted_rank_id' => 'required',
            'file_registration_no' => 'required|unique:promoted_members,file_registration_no|unique:allottee_particulars,reg_file_no',
            'old_p_no' => 'required',
            'new_p_no' => 'required',
            'd_o_p' => 'required',
            'd_o_sod' => 'required',
            'rank_rate' => 'required'
        ];

        $rules2 = [];
        if($request->soldier=='civilian'){
            $rules2 = ([
                'd_o_s' => 'required',
            ]);
        }else{
            $rules2 = ([
                'd_o_sos' => 'required',
            ]);
        }

        $rules = array_merge($rules1, $rules2);

        $this->validate($request, $rules);

        $record = AllotteeParticular::where('p_no', $request->old_p_no)->first();
        $tot_service = '';
        if($request->soldier=='civilian'){
            $start_date = date_create($record->d_o_b);
            $end_date = date_create($request->d_o_s);
            $diff = date_diff($end_date, $start_date);
            $tot_service = '( '.$diff->y.' year '.$diff->m.' month '.$diff->d.' days )';
        }elseif($request->soldier=='uniform'){
            $start_date = date_create($record->d_o_c);
            $end_date = date_create($request->d_o_sos);
            $diff = date_diff($end_date, $start_date);
            $tot_service = '( '.$diff->y.' year '.$diff->m.' month '.$diff->d.' days )';
        }

        $member_emp_record = PromotedMember::create([
            'created_by' => Auth::user()->id,
            'member_id' => $record->id,
            'promoted_rank_id' => $request->promoted_rank_id,
            'file_registration_no' => $request->file_registration_no,
            'old_p_no' => $request->old_p_no,
            'new_p_no' => $request->new_p_no,
            'soldier' => $request->soldier,
            'd_o_p' => date('Y-m-d', strtotime($request->d_o_p)),
            'd_o_sod' => $request->d_o_sod,
            'd_o_sos' => $request->d_o_sos??null,
            'd_o_s' => $request->d_o_s??null,
            'rank_rate' => $request->rank_rate??null,
            'gross_salary' => $request->gross_salary,
            'total_service' => $tot_service,
        ]);

        if($member_emp_record){
           
           //fix this
            $pay_policy = PaymentPolicyData::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('rank_id', $member_emp_record->promoted_rank_id)->first();
           
           
            $last = payableRegInsurance::orderby('id', 'DESC')->where('member_id', $member_emp_record->member_id)->first();
            $total = $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment;
            // $difference  = 0;
            if(!empty($last)){
                $last_amount = $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment;
                $difference = $last_amount-$last->payable_amount;
            }
            // return $total = $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment;
            payableRegInsurance::create([
                'promoted_id' => $member_emp_record->id,
                'member_id' => $member_emp_record->member_id,
                'policy_id' => $pay_policy->hasPaymentPolicy->id,
                'total_amount' => $total,
                'payable_amount' => $difference??$total,
            ]);
        }

        // if($inserted){
        //     $rank = Rank::where('id', $request->promoted_rank_id)->first();
        //     $payment_policy = PaymentPolicy::orderby('id', 'DESC')->where('cat_id', $rank->category)->first();

        //     // $exist = AssignedPolicy::where('p_no', $request->p_no)->where('policy_id', $payment_policy->id)->first();
        //     // if(empty($exist)){
        //     AssignedPolicy::create([
        //         'policy_id' => $payment_policy->id,
        //         'p_no' => $request->old_p_no,
        //     ]);
        //     // }
        // }

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

        $model = PromotedMember::findOrFail($id);

      	return view('promotedMember.show', array('model' => $model));
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
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        $model = PromotedMember::findOrFail($id);

        return view('promotedMember.edit', compact('ranks'))->withModel($model);
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
       $rules1 = [
            'promoted_rank_id' => 'required',
            'file_registration_no' => 'required|unique:promoted_members,file_registration_no|unique:allottee_particulars,reg_file_no',
            'old_p_no' => 'required',
            'new_p_no' => 'required',
            'd_o_p' => 'required',
            'd_o_sod' => 'required',
            'rank_rate' => 'required'
        ];

        $rules2 = [];
        if($request->soldier=='civilian'){
            $rules2 = ([
                'd_o_s' => 'required',
            ]);
        }else{
            $rules2 = ([
                'd_o_sos' => 'required',
            ]);
        }

        $rules = array_merge($rules1, $rules2);

        $this->validate($request, $rules);

        $record = AllotteeParticular::where('p_no', $request->old_p_no)->first();
        $tot_service = '';
        if($request->soldier=='civilian'){
            $start_date = date_create($record->d_o_b);
            $end_date = date_create($request->d_o_s);
            $diff = date_diff($end_date, $start_date);
            $tot_service = '( '.$diff->y.' year '.$diff->m.' month '.$diff->d.' days )';
        }elseif($request->soldier=='uniform'){
            $start_date = date_create($record->d_o_c);
            $end_date = date_create($request->d_o_sos);
            $diff = date_diff($end_date, $start_date);
            $tot_service = '( '.$diff->y.' year '.$diff->m.' month '.$diff->d.' days )';
        }

        $model = PromotedMember::findOrFail($id);
        $model->created_by = Auth::user()->id;
        $model->member_id = $record->id;
        $model->promoted_rank_id = $request->promoted_rank_id;
        $model->file_registration_no = $request->file_registration_no;
        $model->old_p_no = $request->old_p_no;
        $model->new_p_no = $request->new_p_no;
        $model->soldier = $request->soldier;
        $model->d_o_p = $request->d_o_p;
        $model->d_o_sod = $request->d_o_sod;
        $model->rank_rate = $request->rank_rate;

        if($request->soldier=='civilian'){
            $model->d_o_s = $request->d_o_s;
            $model->d_o_sos = null;
        }else{
            $model->d_o_sos = $request->d_o_sos;
            $model->d_o_s = null;
        }

        $model->gross_salary = $request->gross_salary;
        $model->total_service = $tot_service;
        $model->save();

        if($id){
            payableRegInsurance::where('promoted_id', $id)->delete();
            $pay_policy = PaymentPolicyData::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('rank_id', $member_emp_record->promoted_rank_id)->first();

            $last = payableRegInsurance::orderby('id', 'DESC')->where('member_id', $member_emp_record->member_id)->first();
            if(!empty($last)){
                $difference = $last->payable_amount-$pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment;
            }
            $total = $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment;
            payableRegInsurance::create([
                'promoted_id' => $member_emp_record->id,
                'member_id' => $member_emp_record->member_id,
                'policy_id' => $pay_policy->hasPaymentPolicy->id,
                'total_amount' => $total,
                'payable_amount' => $difference??$total,
            ]);
        }

        // if($request->old_p_no){
        //     $rank = Rank::where('id', $request->promoted_rank_id)->first();
        //     $payment_policy = PaymentPolicy::orderby('id', 'DESC')->where('cat_id', $rank->category)->first();

        //     $exist = AssignedPolicy::where('p_no', $request->old_p_no)->where('policy_id', $payment_policy->id)->first();
        //     if(empty($exist)){
        //         AssignedPolicy::create([
        //             'policy_id' => $payment_policy->id,
        //             'p_no' => $request->old_p_no,
        //         ]);
        //     }
        // }

	    Session::flash('flash_message', 'PromotedMember successfully updated!');

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
        return $id;
        $model = PromotedMember::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'PromotedMember successfully deleted!');

	    return redirect()->route('promotedMember.index');
    }

    public function deletePromotedMember($id)
    {
        $model = PromotedMember::findOrFail($id);
        if($model){
            $model->delete();
            return 1;
        }
    }
}

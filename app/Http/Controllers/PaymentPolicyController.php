<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentPolicy;
use App\HouseCategory;
use App\AllotteeParticular;
use Session;
use Illuminate\Support\Facades\Input;
use App\Rank;
use App\PaymentPolicyData;
use App\AssignedPolicy;
use Auth;

class PaymentPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new PaymentPolicy;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = PaymentPolicy::Search();
        }else{
           $models =  PaymentPolicy::with('hasRank', 'hasUserCreatedBy.hasRole', 'hasPolicyAppliedRanks')->orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {
            return view('paymentPolicy.ajax',  compact('models'));
        }

    	
        return view('paymentPolicy.index', compact('models', 'formModel'));
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
        $categories = HouseCategory::where('status', 1)->pluck('name', 'id');
        return view('paymentPolicy.create', compact('ranks', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // 
        $this->validate($request, PaymentPolicy::getValidationRules());
        if($request){
            foreach($request->ranks as $rank){
                $payment_policy = PaymentPolicyData::orderby('id', 'DESC')->where('rank_id', $rank)->first();
                if($payment_policy){
                    $payment_policy->expire_date = $request->effective_date;
                    $payment_policy->update();

                    $policy = PaymentPolicy::where('id', $payment_policy->payment_policy_id)->first();
                    $policy->expire_date = $request->effective_date;
                    $policy->update();
                }
            }
        }

	    $inserted = PaymentPolicy::create([
            'created_by' => Auth()->user()->id,
            'registration_payment' => $request->registration_payment,
            'insurance_payment' => $request->insurance_payment,
            'monthly_instalment' => $request->monthly_instalment,
            'effective_date' => $request->effective_date,
            'status' => $request->status,
        ]);

        if($inserted){
            foreach($request->ranks as $rank){
                PaymentPolicyData::create([
                    'payment_policy_id' => $inserted->id,
                    'rank_id' => $rank,
                    'effective_date' => $inserted->effective_date,
                ]);
            }
        }

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
       
        $model = PaymentPolicy::findOrFail($id);
       
      	return view('paymentPolicy.show', array('model' => $model));
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
        $model = PaymentPolicy::findOrFail($id);
        $categories = HouseCategory::where('status', 1)->pluck('name', 'id');
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        $selected = PaymentPolicyData::where('payment_policy_id', $id)->latest()->pluck('rank_id');
        return view('paymentPolicy.edit', compact('ranks', 'selected', 'categories'))->withModel($model);
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
        $payment_policy = PaymentPolicy::orderby('id', 'DESC')->offset(1)->take(1)->first();
        if(!empty($payment_policy)){
            $payment_policy->expire_date = $request->effective_date;
            $payment_policy->update();
        }

        $model = PaymentPolicy::findOrFail($id);
        $this->validate($request, PaymentPolicy::getValidationRules());
	    $model->created_by = Auth()->user()->id;
        $model->cat_id = $request->cat_id;
        $model->registration_payment = $request->registration_payment;
        $model->insurance_payment = $request->insurance_payment;
	    $model->monthly_instalment = $request->monthly_instalment;
	    $model->effective_date = $request->effective_date;
        $model->status = $request->status;
        $model->save();

        $if_deleted = PaymentPolicyData::where('payment_policy_id', $id)->delete();

        foreach($request->ranks as $rank){
            PaymentPolicyData::create([
                'payment_policy_id' => $id,
                'rank_id' => $rank,
                'effective_date' => $request->effective_date,
            ]);
        }

        //Policy entry        
        if($model){
            $ranks = PaymentPolicyData::where('payment_policy_id', $id)->get(['rank_id']);
            $ranks = AllotteeParticular::whereIn('rank_rate', $ranks)->where('plotassigned', 0)->orwhere('plotassigned', null)->where('get_profit_id', null)->get(['p_no']);
        }

        if($ranks){
            AssignedPolicy::where('policy_id', $id)->delete();
            foreach($ranks as $rank){
                AssignedPolicy::create([
                    'policy_id' => $id,
                    'p_no' => $rank->p_no,
                ]);
            }
        }

	    Session::flash('flash_message', 'PaymentPolicy successfully updated!');

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
        $model = PaymentPolicy::findOrFail($id);
        $model->delete();
        
        PaymentPolicyData::where('payment_policy_id', $id)->delete();

	    Session::flash('flash_message', 'PaymentPolicy successfully deleted!');

	    return redirect()->route('paymentPolicy.index');
    }

    public function deletePaymentPolicy($id)
    {
        $model = PaymentPolicy::where('id', $id)->delete();
        if($model){
            PaymentPolicyData::where('payment_policy_id', $id)->delete();
            return 1;
        }
    }
}

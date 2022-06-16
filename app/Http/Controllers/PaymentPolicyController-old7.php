<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentPolicy;
use Session;
use Illuminate\Support\Facades\Input;
use App\Rank;
use App\PaymentPolicyData;
use App\HouseCategory;
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

	    $inserted = PaymentPolicy::create([
            'created_by' => Auth()->user()->id,
            'cat_id' => $request->cat_id,
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
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        $selected = PaymentPolicyData::where('payment_policy_id', $id)->latest()->pluck('rank_id');
        return view('paymentPolicy.edit', compact('ranks', 'selected'))->withModel($model);
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
        $model = PaymentPolicy::findOrFail($id);
        $this->validate($request, PaymentPolicy::getValidationRules());
	    $model->created_by = Auth()->user()->id;
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
            ]);
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

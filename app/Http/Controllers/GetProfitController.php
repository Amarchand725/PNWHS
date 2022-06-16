<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GetProfit;
use App\MemberProfit;
use App\Payment;
use App\PromotedMember;
use App\AllotteeParticular;
use Session;
use Illuminate\Support\Facades\Input;

class GetProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new GetProfit;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = GetProfit::Search();
        }else{
           $models =  GetProfit::paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('getProfit.ajax',  compact('models'));
        }

    	
        return view('getProfit.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('getProfit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        if($request->status=='searched'){
            $profit_rate = MemberProfit::orderby('id', 'DESC')->first();
            $promoted = PromotedMember::where('new_p_no', $request->p_no)->first();
            if($promoted){
                $found_record = Payment::orderby('id', 'DESC')->where('p_no', $promoted->old_p_no)->first();
                if(empty($found_record)){
                    Session::flash('record_exists', 'Sorry not found!');
                    return view('getProfit.create');
                }else{
                    $found_record = Payment::where('p_no', $promoted->old_p_no)->where('plot_no', '')->where('get_profit_id', '')->first();
                    if($found_record){
                        $paid_amount = Payment::where('p_no', $request->p_no)->sum('sub_monthly_install');
                    }else{
                        Session::flash('record_exists', 'Sorry you are not eligibale!');
                        return view('getProfit.create');
                    }
                }
            }else{
                $found_record = Payment::orderby('id', 'DESC')->where('p_no', $request->p_no)->first();
                if(empty($found_record)){
                    Session::flash('record_exists', 'Sorry not found!');
                    return view('getProfit.create');
                }else{
                    $found_record = Payment::where('p_no', $request->p_no)->where('plot_no', null)->where('get_profit_id', null)->first();
                    if($found_record){
                        $paid_amount = Payment::where('p_no', $request->p_no)->sum('sub_monthly_install');
                    }else{
                        Session::flash('record_exists', 'Sorry you are not eligibale!');
                        return view('getProfit.create');
                    }
                }
            }
            $p_no = $request->p_no;
            return view('getProfit.create', compact('profit_rate', 'paid_amount', 'p_no'));
        }else{
            $this->validate($request, GetProfit::getValidationRules());
            $inserted = GetProfit::create([
                'profit_rate_id' => $request->profit_rate_id,
                'p_no' => $request->p_no,
                'account_of' => 'House Percent',
                'paid_amount' => $request->submitted_amount,
                'profit_amount' => $request->profit_amount,
                'total_amount' => $request->refundable_amount,
            ]);

            $promoted = PromotedMember::where('new_p_no', $request->p_no)->first();
            if(!empty($promoted)){
                $found = Payment::where('p_no', $promoted->old_p_no)->first();
                $member = AllotteeParticular::where('p_no', $promoted->old_p_no)->first();
            }else{
                $found = Payment::where('p_no', $request->p_no)->first();
                $member = AllotteeParticular::where('p_no', $request->p_no)->first();
            }
            
            $found->get_profit_id = $inserted->id;
            $found->payment_status = 2;
            $found->save();

            $member->get_profit_id = $inserted->id;
            $member->save();           

            Session::flash('flash_message', 'Task successfully added!');

            return redirect('GetProfit');
        }
    }

    public function getProfit($id)
    {
        $profit_rate = MemberProfit::orderby('id', 'DESC')->first();
        $promoted = PromotedMember::where('new_p_no', $id)->first();
        if($promoted){
            $found_record = Payment::orderby('id', 'DESC')->where('p_no', $promoted->old_p_no)->first();
            if(empty($found_record)){
                Session::flash('record_exists', 'Sorry not found!');
                return view('getProfit.create');
            }else{
                $found_record = Payment::where('p_no', $promoted->old_p_no)->where('plot_no', '')->where('get_profit_id', '')->first();
                if($found_record){
                    $paid_amount = Payment::where('p_no', $promoted->old_p_no)->sum('sub_monthly_install');
                }else if($found_record->plot_no!='' || $found_record->get_profit_id!=''){
                    Session::flash('record_exists', 'Sorry you are not eligibale!');
                    return view('getProfit.create');
                }
            }
        }else{
            $found_record = Payment::orderby('id', 'DESC')->where('p_no', $id)->first();
            if(empty($found_record)){
                Session::flash('record_exists', 'Sorry not found!');
                return view('getProfit.create');
            }else{
                $found_record = Payment::where('p_no', $request->p_no)->where('plot_no', '')->where('get_profit_id', '')->first();
                if($found_record){
                    $paid_amount = Payment::where('p_no', $promoted->old_p_no)->sum('sub_monthly_install');
                }else{
                    Session::flash('record_exists', 'Sorry you are not eligibale!');
                    return view('getProfit.create');
                }
            }
        }
        $p_no = $id;
        return view('getProfit.create', compact('profit_rate', 'paid_amount', 'p_no'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        $model = GetProfit::findOrFail($id);
       
      	return view('getProfit.show', array('model' => $model));
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
         $model = GetProfit::findOrFail($id);

    return view('getProfit.edit')->withModel($model);
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
       $model = GetProfit::findOrFail($id);

	    $this->validate($request, GetProfit::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'GetProfit successfully updated!');

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
        $model = GetProfit::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'GetProfit successfully deleted!');

	    return redirect()->route('getProfit.index');
    }

    public function releaseProfitPayment(Request $request)
    {
        $profit_record = GetProfit::where('id', $request->get_profit_id)->first();
        $profit_record->payment_method=$request->payment_method;
        $profit_record->ref_cheque_no=$request->ref_cheque_no;
        $profit_record->bank_name=$request->bank_name;
        $profit_record->date=$request->date;
        $profit_record->reciever_name=$request->reciever_name;
        $profit_record->reciever_cnic=$request->reciever_cnic;
        $profit_record->remarks=$request->remarks;
        $profit_record->payment_status='released_payment';
        $profit_record->update();

        // Payment::where()->first();        

        Session::flash('flash_message', 'Payment released, Thanks!');

	    return redirect('GetProfit');
    }

    public function getProfitDetails(Request $request)
    {
        return $profit_record = GetProfit::where('id', $request->profit_id)->first();
    }

    public function reciept($id)
    {
        $model = GetProfit::where('id', $id)->first();
        return view('getProfit.reciept', compact('model'));
    }
}

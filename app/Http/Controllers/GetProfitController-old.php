<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GetProfit;
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
           $models =  GetProfit::paginate(2);
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
        

        $this->validate($request, GetProfit::getValidationRules());

        $input = $request->all();
	    GetProfit::create($input);

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
        $profit_record->beneficiary_name=$request->beneficiary_name;
        $profit_record->ref_cheque_no=$request->ref_cheque_no;
        $profit_record->bank_name=$request->bank_name;
        $profit_record->date=$request->date;
        $profit_record->remarks=$request->remarks;
        $profit_record->payment_status='released_payment';
        $profit_record->update();

        Session::flash('flash_message', 'Payment released, Thanks!');

	    return redirect('GetProfit');
    }

    public function getProfitDetails(Request $request)
    {
        return $profit_record = GetProfit::where('id', $request->profit_id)->first();
    }
}

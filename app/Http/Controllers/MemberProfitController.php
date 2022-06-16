<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberProfit;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;

class MemberProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new MemberProfit;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = MemberProfit::Search();
        }else{
           $models =  MemberProfit::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('memberProfit.ajax',  compact('models'));
        }

    	
        return view('memberProfit.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('memberProfit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, MemberProfit::getValidationRules());

	    MemberProfit::create([
            'rate' => $request->rate,
            'effected_date' => $request->effected_date,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ]);

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
       
        $model = MemberProfit::findOrFail($id);
       
      	return view('memberProfit.show', array('model' => $model));
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
         $model = MemberProfit::findOrFail($id);

    return view('memberProfit.edit')->withModel($model);
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
       $model = MemberProfit::findOrFail($id);

	    $this->validate($request, MemberProfit::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'MemberProfit successfully updated!');

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
        $model = MemberProfit::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'MemberProfit successfully deleted!');

	    return redirect()->route('memberProfit.index');
    }

    public function deleteProfitRate($id)
    {
        $model = MemberProfit::where('id', $id)->delete();
        return 1;
    }
}

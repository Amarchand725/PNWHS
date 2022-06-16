<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthlyInstalment;
use Session;
use Illuminate\Support\Facades\Input;

class MonthlyInstalmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new MonthlyInstalment;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = MonthlyInstalment::Search();
        }else{
           $models =  MonthlyInstalment::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('monthlyInstalment.ajax',  compact('models'));
        }

    	
        return view('monthlyInstalment.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('monthlyInstalment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, MonthlyInstalment::getValidationRules());

	    MonthlyInstalment::create([
            'p_no' => $request->p_no,
            'amount' => $request->amount,
            'paid_date' => $request->paid_date
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
       
        $model = MonthlyInstalment::findOrFail($id);
       
      	return view('monthlyInstalment.show', array('model' => $model));
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
         $model = MonthlyInstalment::findOrFail($id);

    return view('monthlyInstalment.edit')->withModel($model);
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
       $model = MonthlyInstalment::findOrFail($id);

	    $this->validate($request, MonthlyInstalment::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'MonthlyInstalment successfully updated!');

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
        $model = MonthlyInstalment::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'MonthlyInstalment successfully deleted!');

	    return redirect()->route('monthlyInstalment.index');
    }
}

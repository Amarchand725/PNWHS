<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthlyInstallment;
use Session;
use Illuminate\Support\Facades\Input;

class MonthlyInstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new MonthlyInstallment;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = MonthlyInstallment::Search();
        }else{
           $models =  MonthlyInstallment::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('monthlyInstallment.ajax',  compact('models'));
        }

    	
        return view('monthlyInstallment.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('monthlyInstallment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, MonthlyInstallment::getValidationRules());

        $input = $request->all();
	    MonthlyInstallment::create($input);

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
       
        $model = MonthlyInstallment::findOrFail($id);
       
      	return view('monthlyInstallment.show', array('model' => $model));
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
         $model = MonthlyInstallment::findOrFail($id);

    return view('monthlyInstallment.edit')->withModel($model);
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
       $model = MonthlyInstallment::findOrFail($id);

	    $this->validate($request, MonthlyInstallment::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'MonthlyInstallment successfully updated!');

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
        $model = MonthlyInstallment::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'MonthlyInstallment successfully deleted!');

	    return redirect()->route('monthlyInstallment.index');
    }
}

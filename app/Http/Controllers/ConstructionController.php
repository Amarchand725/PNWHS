<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Construction;
use App\Constructor;
use App\Plot;
use Session;
use Illuminate\Support\Facades\Input;
use DB;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cnr = new Controller;
       
        $formModel = new Construction;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Construction::Search();
        }else{
           $models =  Construction::orderby('id', 'DESC')->paginate(20);
        }

        if (\Request::ajax()) {

            return view('construction.ajax',  compact('models','cnr'));
        }

        return view('construction.index', compact('models', 'formModel','cnr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $plots = Plot::where('assign_plot', 0)->pluck('plot_no','id');
        return view('construction.create', compact('plots'));
    }

    public function constructionStatus(Request $request)
    {
        $construction = Construction::findOrFail($request->construction_id);
        $construction->status = $request->status;
        $construction->save();
        Session::flash('flash_message', 'Status Updated Successfully!');
	    return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, Construction::getValidationRules());
        $input = $request->all();
        DB::table('plots')
            ->where('id',$input['plot_id'])
            ->update(['plot_status' => 'not_available']);
        Construction::create($input);
        
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
        $cnr = new Controller;
        $model = Construction::findOrFail($id);
      	return view('construction.show', array('model' => $model,'cnr' => $cnr));
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
        $model = Construction::findOrFail($id);
        return view('construction.edit')->withModel($model);
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
       $model = Construction::findOrFail($id);

	    $this->validate($request, Construction::getValidationRules());
        $input = $request->all();
        unset($input['plot_id']);
	    $model->fill($input)->save();

	    Session::flash('flash_message', 'Construction successfully updated!');

	    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function ledger($id){
        $cnr = new Controller;
        $formModel = new Construction;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Construction::Search();
        }else{
            $models = Construction::where('Constructor_id',$id)->paginate(20);
        }

        if (\Request::ajax()) {
            return view('construction.ajax',  compact('models','cnr'));
        }

        return view('construction.index', compact('models', 'formModel','cnr'));
    }
    
    public function destroy($id)
    {
        //
        $model = Construction::findOrFail($id);
	    $model->delete();
	    Session::flash('flash_message', 'Construction successfully deleted!');
	    return redirect()->back();
    }

    public function deleteConstraction($id)
    {
        Construction::where('id', $id)->delete();
        return 1;
    }
}

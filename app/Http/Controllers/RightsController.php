<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rights;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
class RightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Rights;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Rights::Search();
        }else{
           $models =  Rights::paginate(20);
        }
        
                
        if (\Request::ajax()) {

            return view('rights.ajax',  compact('models'));
        }

    	
        return view('rights.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('rights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Rights::getValidationRules());

        $input = $request->all();
        $input['user_of'] = Auth::id();
        $input['created_by'] = Auth::id();
	    Rights::create($input);

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
       
        $model = Rights::findOrFail($id);
       
      	return view('rights.show', array('model' => $model));
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
         $model = Rights::findOrFail($id);

    return view('rights.edit')->withModel($model);
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
       $model = Rights::findOrFail($id);
	    $this->validate($request, Rights::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Rights successfully updated!');

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
        $model = Rights::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Rights successfully deleted!');

	    return redirect()->back();
    }
}

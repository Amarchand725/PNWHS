<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House_alloted_details;
use Session;
use Illuminate\Support\Facades\Input;

class House_alloted_detailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new House_alloted_details;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = House_alloted_details::Search();
        }else{
           $models =  House_alloted_details::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('house_alloted_details.ajax',  compact('models'));
        }

    	
        return view('house_alloted_details.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('house_alloted_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, House_alloted_details::getValidationRules());

        $input = $request->all();
	    House_alloted_details::create($input);

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
       
        $model = House_alloted_details::findOrFail($id);
       
      	return view('house_alloted_details.show', array('model' => $model));
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
         $model = House_alloted_details::findOrFail($id);

    return view('house_alloted_details.edit')->withModel($model);
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
       $model = House_alloted_details::findOrFail($id);

	    $this->validate($request, House_alloted_details::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'House_alloted_details successfully updated!');

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
        $model = House_alloted_details::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'House_alloted_details successfully deleted!');

	    return redirect()->route('house_alloted_details.index');
    }
}

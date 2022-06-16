<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propertytype;
use Session;
use Illuminate\Support\Facades\Input;

class PropertytypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Propertytype;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Propertytype::Search();
        }else{
           $models =  Propertytype::paginate(50);
        }
        
                
        if (\Request::ajax()) {

            return view('propertytype.ajax',  compact('models'));
        }

    	
        return view('propertytype.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('propertytype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Propertytype::getValidationRules());

        $input = $request->all();
	    Propertytype::create($input);

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
       
        $model = Propertytype::findOrFail($id);
       
      	return view('propertytype.show', array('model' => $model));
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
         $model = Propertytype::findOrFail($id);

    return view('propertytype.edit')->withModel($model);
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
       $model = Propertytype::findOrFail($id);

	    $this->validate($request, Propertytype::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Propertytype successfully updated!');

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
        $model = Propertytype::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Propertytype successfully deleted!');

	    return redirect()->route('propertytype.index');
    }
}

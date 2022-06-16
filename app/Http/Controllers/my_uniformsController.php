<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\my_uniforms;
use Session;
use Illuminate\Support\Facades\Input;

class my_uniformsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new my_uniforms;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = my_uniforms::Search();
        }else{
           $models =  my_uniforms::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('my_uniforms.ajax',  compact('models'));
        }

    	
        return view('my_uniforms.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('my_uniforms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, my_uniforms::getValidationRules());

        $input = $request->all();
	    my_uniforms::create($input);

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
       
        $model = my_uniforms::findOrFail($id);
       
      	return view('my_uniforms.show', array('model' => $model));
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
         $model = my_uniforms::findOrFail($id);

    return view('my_uniforms.edit')->withModel($model);
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
       $model = my_uniforms::findOrFail($id);

	    $this->validate($request, my_uniforms::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'my_uniforms successfully updated!');

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
        $model = my_uniforms::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'my_uniforms successfully deleted!');

	    return redirect()->route('my_uniforms.index');
    }
}

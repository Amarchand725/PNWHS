<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyUniform;
use Session;
use Illuminate\Support\Facades\Input;

class MyUniformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $formModel = new MyUniform;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = MyUniform::Search();
        }else{
           $models =  MyUniform::paginate(2);
        }


        if (\Request::ajax()) {

            return view('myUniform.ajax',  compact('models'));
        }


        return view('myUniform.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('myUniform.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //


        $this->validate($request, MyUniform::getValidationRules());

        $input = $request->all();
	    MyUniform::create($input);

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

        $model = MyUniform::findOrFail($id);

      	return view('myUniform.show', array('model' => $model));
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
         $model = MyUniform::findOrFail($id);

    return view('myUniform.edit')->withModel($model);
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
       $model = MyUniform::findOrFail($id);

	    $this->validate($request, MyUniform::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'MyUniform successfully updated!');

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
        $model = MyUniform::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'MyUniform successfully deleted!');

	    return redirect()->route('myUniform.index');
    }
}

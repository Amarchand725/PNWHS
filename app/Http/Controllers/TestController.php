<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use Session;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Test;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Test::Search();
        }else{
           $models =  Test::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('test.ajax',  compact('models'));
        }

    	
        return view('test.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Test::getValidationRules());

        $input = $request->all();
	    Test::create($input);

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
       
        $model = Test::findOrFail($id);
       
      	return view('test.show', array('model' => $model));
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
         $model = Test::findOrFail($id);

    return view('test.edit')->withModel($model);
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
       $model = Test::findOrFail($id);

	    $this->validate($request, Test::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Test successfully updated!');

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
        $model = Test::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Test successfully deleted!');

	    return redirect()->route('test.index');
    }
}

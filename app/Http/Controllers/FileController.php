<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Session;
use Illuminate\Support\Facades\Input;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new File;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = File::Search();
        }else{
           $models =  File::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('file.ajax',  compact('models'));
        }

    	
        return view('file.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, File::getValidationRules());

        $input = $request->all();
	    File::create($input);

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
       
        $model = File::findOrFail($id);
       
      	return view('file.show', array('model' => $model));
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
         $model = File::findOrFail($id);

    return view('file.edit')->withModel($model);
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
       $model = File::findOrFail($id);

	    $this->validate($request, File::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'File successfully updated!');

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
        $model = File::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'File successfully deleted!');

	    return redirect()->route('file.index');
    }
}

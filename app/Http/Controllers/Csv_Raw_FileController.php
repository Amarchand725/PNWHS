<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Csv_Raw_File;
use Session;
use Illuminate\Support\Facades\Input;

class Csv_Raw_FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Csv_Raw_File;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Csv_Raw_File::Search();
        }else{
           $models =  Csv_Raw_File::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('csv_Raw_File.ajax',  compact('models'));
        }

    	
        return view('csv_Raw_File.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('csv_Raw_File.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Csv_Raw_File::getValidationRules());

        $input = $request->all();
	    Csv_Raw_File::create($input);

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
       
        $model = Csv_Raw_File::findOrFail($id);
       
      	return view('csv_Raw_File.show', array('model' => $model));
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
         $model = Csv_Raw_File::findOrFail($id);

    return view('csv_Raw_File.edit')->withModel($model);
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
       $model = Csv_Raw_File::findOrFail($id);

	    $this->validate($request, Csv_Raw_File::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Csv_Raw_File successfully updated!');

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
        $model = Csv_Raw_File::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Csv_Raw_File successfully deleted!');

	    return redirect()->route('csv_Raw_File.index');
    }
}

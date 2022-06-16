<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CsvData;
use Session;
use Illuminate\Support\Facades\Input;

class CsvDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new CsvData;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = CsvData::Search();
        }else{
           $models =  CsvData::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('csvData.ajax',  compact('models'));
        }

    	
        return view('csvData.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('csvData.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, CsvData::getValidationRules());

        $input = $request->all();
	    CsvData::create($input);

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
       
        $model = CsvData::findOrFail($id);
       
      	return view('csvData.show', array('model' => $model));
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
         $model = CsvData::findOrFail($id);

    return view('csvData.edit')->withModel($model);
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
       $model = CsvData::findOrFail($id);

	    $this->validate($request, CsvData::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'CsvData successfully updated!');

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
        $model = CsvData::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'CsvData successfully deleted!');

	    return redirect()->route('csvData.index');
    }
}

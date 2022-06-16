<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CsvRawData;
use Session;
use Illuminate\Support\Facades\Input;

class CsvRawDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new CsvRawData;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = CsvRawData::Search();
        }else{
           $models =  CsvRawData::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('csvRawData.ajax',  compact('models'));
        }

    	
        return view('csvRawData.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('csvRawData.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, CsvRawData::getValidationRules());

        $input = $request->all();
	    CsvRawData::create($input);

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
       
        $model = CsvRawData::findOrFail($id);
       
      	return view('csvRawData.show', array('model' => $model));
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
         $model = CsvRawData::findOrFail($id);

    return view('csvRawData.edit')->withModel($model);
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
       $model = CsvRawData::findOrFail($id);

	    $this->validate($request, CsvRawData::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'CsvRawData successfully updated!');

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
        $model = CsvRawData::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'CsvRawData successfully deleted!');

	    return redirect()->route('csvRawData.index');
    }
}

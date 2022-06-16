<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Construction;
use Session;
use Illuminate\Support\Facades\Input;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new Constructor;
        $formModel->fill(Input::get());
        if(isset($_GET['submit'])){
            $models = Constructor::Search();
        }else{
           $models =  Constructor::orderby('id', 'desc')->paginate(10);
        }    
        if (\Request::ajax()) {
            return view('constructor.ajax',  compact('models'));
        }
        return view('constructor.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('constructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, Constructor::getValidationRules());
        $input = $request->all();
       
        if (!empty($request->hasFile('image'))) {
            $file = $request->file('image');
            $file->move(public_path('attachment'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $input['image'] = $file_name;
        }
        
	    Constructor::create($input);

	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect()->back();
    }

    
    public function contructorLedger($id)
    {
        $constructor_constructions = Construction::orderby('id', 'DESC')->where('constructor_id', $id)->get();
        return view('constructor.ledger', compact('constructor_constructions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        $model = Constructor::findOrFail($id);
      	return view('constructor.show', array('model' => $model));
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
         $model = Constructor::findOrFail($id);

    return view('constructor.edit')->withModel($model);
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
        $model = Constructor::findOrFail($id);
        $this->validate($request, Constructor::getValidationRules());
        $model->fill( $request->all());
        $temp = array();
        if (!empty($request->hasFile('image'))) {
            $file = $request->file('image');
            $file->move(public_path('attachment'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $input['image'] = $file_name;
            $model->image = $file_name;
        }
        $model->save();

	    Session::flash('flash_message', 'Constructor successfully updated!');

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
        $model = Constructor::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Constructor successfully deleted!');

	    return redirect()->back();
    }

    public function deleteContractor($id)
    {
        Constructor::where('id', $id)->delete();
        return 1;
    }
}

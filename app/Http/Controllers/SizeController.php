<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use Session;
use Illuminate\Support\Facades\Input;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Size;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Size::Search();
        }else{
           $models =  Size::paginate(50);
        }
        
                
        if (\Request::ajax()) {

            return view('size.ajax',  compact('models'));
        }

    	
        return view('size.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Size::getValidationRules());

        $input = $request->all();
        $input['property_type'] = $input['type'];
	    Size::create($input);

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
       
        $model = Size::findOrFail($id);
       
      	return view('size.show', array('model' => $model));
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
         $model = Size::findOrFail($id);

    return view('size.edit')->withModel($model);
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
       $model = Size::findOrFail($id);

	    $this->validate($request, Size::getValidationRules());

       $dd = $model->fill( $request->all() )->save();
       

	    Session::flash('flash_message', 'Size successfully updated!');

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
        $model = Size::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Size successfully deleted!');

	    return redirect()->route('size.index');
    }
}

<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AllotedHouse;
use Session;
use Illuminate\Support\Facades\Input;

class AllotedHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new AllotedHouse;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = AllotedHouse::Search();
        }else{
           $models =  AllotedHouse::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('allotedHouse.ajax',  compact('models'));
        }

    	
        return view('allotedHouse.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('allotedHouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, AllotedHouse::getValidationRules());

        $input = $request->all();
	    AllotedHouse::create($input);

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
       
        $model = AllotedHouse::findOrFail($id);
       
      	return view('allotedHouse.show', array('model' => $model));
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
         $model = AllotedHouse::findOrFail($id);

    return view('allotedHouse.edit')->withModel($model);
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
       $model = AllotedHouse::findOrFail($id);

	    $this->validate($request, AllotedHouse::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'AllotedHouse successfully updated!');

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
        $model = AllotedHouse::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'AllotedHouse successfully deleted!');

	    return redirect()->route('allotedHouse.index');
    }
}

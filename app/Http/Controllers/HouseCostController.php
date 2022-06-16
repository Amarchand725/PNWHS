<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HouseCost;
use App\HouseCategory;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;

class HouseCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new HouseCost;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = HouseCost::Search();
        }else{
           $models =  HouseCost::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('houseCost.ajax',  compact('models'));
        }

    	
        return view('houseCost.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $house_categories = HouseCategory::where('status', 1)->get();
        return view('houseCost.create', compact('house_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, HouseCost::getValidationRules());
	    HouseCost::create([
            'initial_cost' => $request->initial_cost,
            'category_id' => $request->category_id,
            'created_by' => Auth::user()->id
        ]);

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
       
        $model = HouseCost::findOrFail($id);
       
      	return view('houseCost.show', array('model' => $model));
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
        $house_categories = HouseCategory::where('status', 1)->get();
        $model = HouseCost::findOrFail($id);
        return view('houseCost.edit', compact('house_categories'))->withModel($model);
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
       $model = HouseCost::findOrFail($id);

	    $this->validate($request, HouseCost::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'HouseCost successfully updated!');

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
        $model = HouseCost::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'HouseCost successfully deleted!');

	    return redirect()->route('houseCost.index');
    }

    public function deleteHouseCost($id)
    {
        $model = HouseCost::where('id', $id)->delete();
        return 1;
    }
}

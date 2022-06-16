<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rank;
use App\HouseCategory;
use Session;
use Illuminate\Support\Facades\Input;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Rank;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Rank::Search();
        }else{
           $models =  Rank::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('rank.ajax',  compact('models'));
        }

    	
        return view('rank.index', compact('models', 'formModel'));
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
        return view('rank.create', compact('house_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, Rank::getValidationRules());
        $rules = [
            'name' => 'required|unique:ranks',
        ];
        $this->validate($request, $rules);
        
        $input = $request->all();
	    Rank::create($input);

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
        $model = Rank::findOrFail($id);
       
      	return view('rank.show', array('model' => $model));
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
        $model = Rank::findOrFail($id);
        $house_categories = HouseCategory::where('status', 1)->get();
        return view('rank.edit', compact('house_categories'))->withModel($model);
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
       $model = Rank::findOrFail($id);

	    $this->validate($request, Rank::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Rank successfully updated!');

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
        $model = Rank::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Rank successfully deleted!');

	    return redirect()->route('rank.index');
    }

    public function deleteRank($id)
    {
        $model = Rank::where('id', $id)->delete();
        return 1;
    }
}

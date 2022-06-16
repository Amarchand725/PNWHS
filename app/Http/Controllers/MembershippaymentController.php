<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membershippayment;
use Session;
use Illuminate\Support\Facades\Input;
use App\Rank;

class MembershippaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Membershippayment;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Membershippayment::Search();
        }else{
           $models =  Membershippayment::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('membershippayment.ajax',  compact('models'));
        }

    	
        return view('membershippayment.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('membershippayment.create', compact('ranks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, Membershippayment::getValidationRules());

	    Membershippayment::create([
            'mpayment' => $request->mpayment,
            'm_rank' => $request->m_rank,
            'effective_date' => $request->effective_date,
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
       
        $model = Membershippayment::findOrFail($id);
       
      	return view('membershippayment.show', array('model' => $model));
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
        $model = Membershippayment::findOrFail($id);
        return view('membershippayment.edit')->withModel($model);
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
       $model = Membershippayment::findOrFail($id);

	    $this->validate($request, Membershippayment::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Membershippayment successfully updated!');

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
        $model = Membershippayment::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Membershippayment successfully deleted!');

	    return redirect()->route('membershippayment.index');
    }
}

<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromotedMember;
use App\Rank;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;

class PromotedMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new PromotedMember;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = PromotedMember::Search();
        }else{
           $models =  PromotedMember::orderby('id', 'DESC')->paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('promotedMember.ajax',  compact('models'));
        }

    	
        return view('promotedMember.index', compact('models', 'formModel'));
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
        return view('promotedMember.create', compact('ranks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, PromotedMember::getValidationRules());
        $ifexist = PromotedMember::where('new_p_no', $request->new_p_no)->first();
        
        if(empty($ifexist)){
            PromotedMember::create([
                'created_by' => Auth::user()->id,
                'promoted_rank_id' => $request->promoted_rank_id,
                'file_registration_no' => $request->file_registration_no,
                'old_p_no' => $request->old_p_no,
                'new_p_no' => $request->new_p_no,
                'soldier' => $request->soldier,
                'd_o_p' => $request->d_o_p,
                'd_o_sod' => $request->d_o_sod,
                'd_o_sos' => $request->d_o_sos,
                'd_o_s' => $request->d_o_s,
                'gross_salary' => $request->gross_salary,
            ]);

            Session::flash('flash_message', 'Task successfully added!');
        }else{
            Session::flash('record_exists', 'Sorry! This P/PJO No is exist.');
        }

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
       
        $model = PromotedMember::findOrFail($id);
       
      	return view('promotedMember.show', array('model' => $model));
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
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        $model = PromotedMember::findOrFail($id);

        return view('promotedMember.edit', compact('ranks'))->withModel($model);
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
       $model = PromotedMember::findOrFail($id);

	    $this->validate($request, PromotedMember::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'PromotedMember successfully updated!');

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
        return $id;
        $model = PromotedMember::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'PromotedMember successfully deleted!');

	    return redirect()->route('promotedMember.index');
    }
    
    public function deletePromotedMember($id)
    {
        $model = PromotedMember::findOrFail($id);
        if($model){
            $model->delete();
            return 1;
        }
    }
}

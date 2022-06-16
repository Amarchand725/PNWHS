<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserType;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new UserType;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = UserType::Search();
        }else{
           $models =  UserType::paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('userType.ajax',  compact('models'));
        }

    	
        return view('userType.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('userType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, UserType::getValidationRules());
        $input = $request->all();
        $rights = $input['rights_id'];
        $input['rights_id'] = json_encode($rights);
        $input['created_by'] = Auth::user()->id;
        $input['user_of'] = Auth::user()->id;

	    UserType::create($input);

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
       
        $model = UserType::findOrFail($id);
       
      	return view('userType.show', array('model' => $model));
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
         $model = UserType::findOrFail($id);

    return view('userType.edit')->withModel($model);
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
       $model = UserType::findOrFail($id);

	    $this->validate($request, UserType::getValidationRules());

	    $model->fill($request->all());
        $ids = $request->rights_id;
        $model->rights_id = json_encode($ids);
        $model->save();
	    Session::flash('flash_message', 'UserType successfully updated!');

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
        $model = UserType::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'UserType successfully deleted!');

	    return redirect()->back();
    }
}

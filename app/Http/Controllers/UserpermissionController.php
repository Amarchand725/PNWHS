<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userpermission;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;
class UserpermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usermanagement');

    }
    public function index()
    {
        
        $formModel = new Userpermission;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Userpermission::Search();
        }else{
         
                  $models =  Userpermission::paginate(15);
        }
       // echo '<pre>';print_r($models);die;
                
        if (\Request::ajax()) {

            return view('userpermission.ajax',  compact('models'));
        }

    	
        return view('userpermission.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('userpermission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Userpermission::getValidationRules());

        $input = $request->all();
        $input['parent_id'] = Auth::id();
	    Userpermission::create($input);

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
       
        $model = Userpermission::findOrFail($id);
       
      	return view('userpermission.show', array('model' => $model));
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
         $model = Userpermission::findOrFail($id);

    return view('userpermission.edit')->withModel($model);
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
       $model = Userpermission::findOrFail($id);

	    $this->validate($request, Userpermission::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Userpermission successfully updated!');

	    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $id = $_POST['account_id'];
        $model = Userpermission::findOrFail($id);
	    $model->delete();
        if($model){
			echo "Success";
		}
        //
    
    }
}

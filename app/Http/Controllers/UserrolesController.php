<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userroles;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class UserrolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     * 
     */
     
      public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('usermanagement');
  

    }
     
     
    public function index()
    {
        $formModel = new Userroles;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Userroles::Search();
        }else{
       
           
                $models =  Userroles::paginate(15);  
            
         
        }
        if (\Request::ajax()) {
            return view('userroles.ajax',  compact('models'));
        }
        return view('userroles.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('userroles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Userroles::getValidationRules());

        $input = $request->all();
        $input['parent_id'] = Auth::id();
	    Userroles::create($input);

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

        $model = Userroles::findOrFail($id);
      	return view('userroles.show', array('model' => $model));
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
         $model = Userroles::findOrFail($id);

    return view('userroles.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function editpermission($id){
        $roleid=$id;
   // $userpermission =    DB::table('user_permission')->paginate(15);
     
  $usersdataa =  DB::table('userroles')->where('id',$roleid)->first();
 
    
        $userrightsjson =  json_decode($usersdataa->rights);
        $userpermission =    DB::table('user_permission')->paginate(15);
        return view('userroles.editpermission',array('userpermission' => $userpermission,'roleid'=>$roleid,'userrightsjson' => $userrightsjson));
    }
    public function editpermissionstore(){
     $permissionid=$_POST['userid'];
      $rights = $_POST['checkeddata'];
    $rightss =   ucwords($_POST['checkeddata']);
    DB::table('userroles')->where('id',$permissionid)->update(['rights' =>  $rightss]);
    return redirect()->back();
    }
    public function update($id, Request $request)
    {
        //
       $model = Userroles::findOrFail($id);

	    $this->validate($request, Userroles::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Userroles successfully updated!');

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
        //
        $id = $_POST['account_id'];
        $model = Userroles::findOrFail($id);
	    $model->delete();
        if($model){
			echo "Success";
		}
    }
}

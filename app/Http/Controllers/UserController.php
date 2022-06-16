<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
 
    public function index()
    {
        
        $formModel = new User;
        $formModel->fill(Input::get());
        if(isset($_GET['submit'])){
            $models = User::Search();
        }else{
           if (Auth::user()->user_type == 1) {
               $models =  User::paginate(30);
           }else{
                $models =  User::where('created_by', Auth::id())->paginate(30);
           }
        }
          
        if (\Request::ajax()) {

            return view('user.ajax',  compact('models'));
        }

        return view('user.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $superadmin = 'App\UserType'::where('statuss','1')->pluck('name','id');
        $cities = DB::table('cities')->get();
        return view('user.create', array('superadmin' => $superadmin,'cities' => $cities));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(Request $request)
    {
       // echo "<pre>"; print_r($_POST); die;
        $validatedData = $request->validate([
         'first_name' => 'required|max:255',
         'last_name' => 'required|max:255',
         'user_name' => 'required|unique:users|max:255',
         'email' => 'required|unique:users|max:255',
         'user_type' => 'required',
         'mobile_no' => 'required',
         'password' => 'required|min:1',
         'phone' => '',
         ]);    
        
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $input['user_of'] = Auth::user()->id;
        $input['password'] = bcrypt($request['password']);
        $model = User::create($input);     
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
       
        $model = User::findOrFail($id);
       
      	return view('user.show', array('model' => $model));
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
         $model = User::findOrFail($id);

    return view('user.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
   
        $model = User::findOrFail($id);
        
        $model->fill( $request->all());
        $model->password = bcrypt($request->password);
        $model->save();
	    Session::flash('flash_message', 'User successfully updated!');

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
        $model = User::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'User successfully deleted!');

	    return redirect()->back();
    }
}

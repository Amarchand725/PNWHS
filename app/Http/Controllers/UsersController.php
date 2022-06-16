<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Account;
use Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
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
        $formModel = new Users;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Users::Search();
        }else{
            $user_type = Auth::user()->userType;
            if($user_type->name=='admin'){
                $models = Users::orderby('id', 'DESC')->where('user_type', '!=', $user_type->id)->paginate(10);
            }else{
                $models = Users::orderby('id', 'DESC')->paginate(10);
            }
        }
        if (\Request::ajax()) {
            return view('users.ajax',  compact('models'));
        }
        return view('users.index', compact('models', 'formModel'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function ChangePassword($id)
    {
        $change_password_user_id = $id;
        return view('users.changepassword',array('id'=>$change_password_user_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeChangePassword($id)
    {
        $formModel = new Users;
        $formModel->fill(Input::get());
        if(isset($_GET['submit'])){
            $models = Users::Search();
        }else{
            $models = Users::paginate(10);
        }
        $user_id = $id;
        $oldpassword = bcrypt($_POST['password']);
        $newpassword = $_POST['newpassword'];
        $retype = $_POST['retype'];
        $user_acc_information = Users::where('id',$user_id)->first();
        if(Hash::check($_POST['password'], $user_acc_information->password)){

            DB::table('users')
            ->where('id', $user_id)
            ->update(['password' => bcrypt($_POST['retype'])]);
            Session::flash('flash_message', 'Password Updated !');
           }
        else{

        Session::flash('password_check', 'Password Not Updated !');

        }

        return redirect()->route('Users.index');

    }
    public function store(Request $request)
    {
        //
        $this->validate($request, Users::getValidationRules());

        DB::beginTransaction();
        try {
            $users = new Users;
			$users->p_no = $request->p_no;
			$users->name = $request->name;
            $users->is_active = 1;
			$users->user_type = $request->user_type;
			$users->created_by = Auth::id(); // current user ID
            $users->email = $request->email;
            $users->role = $request->role;
			$users->password = bcrypt($request->password);
			$users->remember_token = '-';
			$users->save();

            DB::commit();
            Session::flash('flash_message', 'User successfully Added!');

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
            Session::flash('flash_message', 'Error');
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
        $model = Users::findOrFail($id);

      	return view('users.show', array('model' => $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
         $model = Users::findOrFail($id);
         return view('users.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $model = Users::findOrFail($id);
	    $this->validate($request, Users::getValidationRules());
        $model->name = $request->name;
        $model->user_type = $request->user_type;
        $model->email = $request->email;
        $model->role = $request->role;
        $model->save();
	    Session::flash('flash_message', 'Users successfully updated!');
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
        DB::table('users')->where('id',$id)->delete();

	    Session::flash('flash_message', 'User successfully Deleted!');
	    return redirect()->back();
    }

        public function statusupdates(){

           $userid =  $_POST['user_id'];
           $selected_value =  $_POST['selected_value'];
          // echo $userid.'/////'.$selected_value;die;
           if($selected_value == 0){
            DB::table('users')
            ->where('id', $userid)
            ->update(['is_active' => 1]);
            echo '1';
           }
            if($selected_value == 1){
            DB::table('users')
            ->where('id', $userid)
            ->update(['is_active' => 0]);
            echo '0';
           }
           else{
            echo 'not update';
           }


        }

        //all Status update
        public function status($status){
        DB::table('users')
            ->where('user_type', 'admin')
            ->update(['is_active' => $status]);

          return  redirect()->back();
        }
        public function checkpass(){
         // echo  bcrypt($_POST['currentpassword']);die;
           $pass =  Hash::make(($_POST['currentpassword']));
           $data =  DB::table('users')->where('id',$_POST['user_id'])->where('password',$pass)->get();
           if(!empty($data)){
                echo '1';
           }
           else{
            echo '0';
           }
        }

    public function userProfile()
    {
      	return view('users.profile');
    }
}

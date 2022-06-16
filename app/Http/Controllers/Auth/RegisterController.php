<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Users;
use Session;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\UserType;
use App\Userroles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createNewUser()
    {
        return view('auth.create');
    }

    public function userStore(Request $request)
    {
        $rules = ([
            'p_no' => 'required',
            'name' => 'required',
            'cell' => 'required',
        ]);

        $this->validate($request, $rules);

        $ifexist = Users::where('p_no', $request->p_no)->first();
        if(!$ifexist){
            $user_type = UserType::where('name', 'user')->first();
            $user_role = Userroles::where('role', 'user')->first();
            Users::create([
                'p_no' => $request->p_no,
                'name' => $request->name,
                'user_type' => $user_type->id, //User Type ID
                'role' => $user_role->id, //User Role ID
                'created_by' => Auth::user()->id??null, 
                'cell' => $request->cell, 
                'email' => $request->p_no, 
                'password' => bcrypt($request->password??$request->p_no),
            ]);  

            Session::flash('flash_message', 'You are registered successfully wait for approval.!');
            return redirect('/login');
        }else{
            Session::flash('record_exists', 'You are already registered.!');
            return back();
        }
    }
}
<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller 
{
    
    // Login User
    public function login(){ // OK
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    // Create User
    public function register(Request $request){ // OK
        $validator = Validator::make($request->all(), [ 
         'first_name' => 'required|max:255',
         'last_name' => 'required|max:255',
         'user_name' => 'required|unique:users|max:255',
         'email' => 'required|unique:users|max:255',
         'user_type' => 'required',
         'mobile_no' => 'required',
         'password' => 'required|min:1',
         'phone' => '',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['email'] =  $user->email;
        return response()->json(['success'=>$success], 200); 

    }

    // Update User
    public function update($id, Request $request){ // OK
      $user = User::findOrFail($id);
      $user->update($request->all());
      $user->password = bcrypt($user->password);
      $user->save();
      return response()->json($user);

    }

    // Show All Users
    public function show(){ // OK
       $user = User::all();
       return response()->json(['success' => $user], 200);
    }

    // Show User By User ID 
    public function showbyid($id){ // OK
       $user = User::findOrFail($id);
       return response()->json(['success' => $user], 200);
    }

    // Delete user
    public function delete($id){ // OK
      $user = User::findOrFail($id);
      $user->delete();
      return response()->json(['success' => $user], 200);
    }

    // Logout User
    public function logout(Request $request) {
      $token= $request->user()->api_token->find($token);
      $token->revoke();
      return response()->json(['success' => $token], 200);
    }

}
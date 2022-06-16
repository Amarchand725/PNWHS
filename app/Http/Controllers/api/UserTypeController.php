<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\UserType;
use Illuminate\Support\Facades\Auth;

class UserTypeController extends Controller 
{
    
  public function create(Request $request){ // OK
    $input = $request->all();
    $input['created_by'] = Auth::id();
    $input['user_of'] = Auth::id();
    $userType = UserType::create($input); 
    return response()->json(['success' => $userType], 200);
  }

  public function update($id, Request $request){ //
      $userType = UserType::findOrFail($id);
      $userType->update($request->all());
      $userType->save();
      return response()->json($userType);
  }

  // Show All UserType
    public function show(){ // OK
       $userType = UserType::all();
       return response()->json(['success' => $userType], 200);
    }

    // Show UserType By UserType ID 
    public function showbyid($id){ // OK
       $userType = UserType::findOrFail($id);
       return response()->json(['success' => $userType], 200);
    }

    public function delete($id){ // OK
      $userType = UserType::findOrFail($id);
      $userType->delete();
      return response()->json(['success' => $userType], 200);
    }

}
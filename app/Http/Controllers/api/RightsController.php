<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Rights;
use Illuminate\Support\Facades\Auth;

class RightsController extends Controller 
{
    
  public function create(Request $request){ // OK
    $input = $request->all();
    $input['created_by'] = Auth::id();
    $input['user_of'] = Auth::id();
    $rights = Rights::create($input); 
    return response()->json(['success' => $rights], 200);
  }

  public function update($id, Request $request){ //
      $rights = Rights::findOrFail($id);
      $rights->update($request->all());
      $rights->save();
      return response()->json($rights);
  }

  // Show All Rights
    public function show(){ // OK
       $rights = Rights::all();
       return response()->json(['success' => $rights], 200);
    }

    // Show Rights By Rights ID 
    public function showbyid($id){ // OK
       $rights = Rights::findOrFail($id);
       return response()->json(['success' => $rights], 200);
    }

    public function delete($id){ // OK
      $rights = Rights::findOrFail($id);
      $rights->delete();
      return response()->json(['success' => $rights], 200);
    }

}
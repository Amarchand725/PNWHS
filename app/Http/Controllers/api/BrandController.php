<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller 
{
    
  public function create(Request $request){ // OK
    $input = $request->all();
    $input['created_by'] = Auth::id();
    $brand = Brand::create($input);
    return response()->json(['success' => $brand], 200);
  }

  public function update($id, Request $request){ //
      $brand = Brand::findOrFail($id);
      $brand->update($request->all());
      $brand->save();
      return response()->json($brand);
  }

  // Show All Brand
    public function show(){ // OK
       $brand = Brand::all();
       return response()->json(['success' => $brand], 200);
    }

    // Show Brand By Brand ID 
    public function showbyid($id){ // OK
       $brand = Brand::findOrFail($id);
       return response()->json(['success' => $brand], 200);
    }

    public function delete($id){ // OK
      $brand = Brand::findOrFail($id);
      $brand->delete();
      return response()->json(['success' => $brand], 200);
    }

}
<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Constructor extends Model
{
    
	protected $table = 'constructor';
	  
	protected $fillable = [
        'id','name','email','image','address','description','mobile_no','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
			'image' => 'required',
			'name' => 'required',
			'email' => 'required',
			'mobile_no' => 'required',
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Constructor::table('Constructor'); // it will also work , make sure table case is correct
    	$query = Constructor::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
    			} 
if(!empty(Input::get("email"))){
    			$query->where("email","=",Input::get("email"));
    			} 
if(!empty(Input::get("description"))){
    			$query->where("description","=",Input::get("description"));
    			} 
if(!empty(Input::get("mobile_no"))){
    			$query->where("mobile_no","=",Input::get("mobile_no"));
    			} 
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			} 
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(10);
		//print_r($result);die();
		return $result;

    }
}

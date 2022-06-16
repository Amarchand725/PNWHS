<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Userroles extends Model
{
    
	protected $table = 'userroles';
	  
	protected $fillable = [
        'id','role','rights','description','parent_id','is_active','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','role' => 'required','rights' => '','description' => '','is_active' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Userroles::table('Userroles'); // it will also work , make sure table case is correct
    	$query = Userroles::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("role"))){
    			$query->where("role","=",Input::get("role"));
    			} 
if(!empty(Input::get("rights"))){
    			$query->where("rights","=",Input::get("rights"));
    			} 
if(!empty(Input::get("description"))){
    			$query->where("description","=",Input::get("description"));
    			} 
if(!empty(Input::get("is_active"))){
    			$query->where("is_active","=",Input::get("is_active"));
    			} 
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			} 
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(2);
		//print_r($result);die();
		return $result;

    }
}

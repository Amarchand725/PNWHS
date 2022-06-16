<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rights extends Model
{
    
	protected $table = 'rights';
	  
	protected $fillable = [
        'id',
        'name',
        'description',
        'status',
        'user_of',
        'created_by',
        'created_at',
        'updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '',
            'name' => 'required',
            'description' => '',
            'status' => '',
            'user_of' => '',
            'created_by' => '',
            'created_at' => '',
            'updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Rights::table('Rights'); // it will also work , make sure table case is correct
    	$query = Rights::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
    			} 
if(!empty(Input::get("description"))){
    			$query->where("description","=",Input::get("description"));
    			} 
if(!empty(Input::get("status"))){
    			$query->where("status","=",Input::get("status"));
    			} 
if(!empty(Input::get("user_of"))){
    			$query->where("user_of","=",Input::get("user_of"));
    			} 
if(!empty(Input::get("created_by"))){
    			$query->where("created_by","=",Input::get("created_by"));
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

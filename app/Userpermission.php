<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Userpermission extends Model
{
    
	protected $table = 'user_permission';
	  
	protected $fillable = [
        'id','name','description','parent_id','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','name' => 'required','description' => 'required','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Userpermission::table('Userpermission'); // it will also work , make sure table case is correct
    	$query = Userpermission::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("name"))){
 $name = str_replace("-","_",Input::get("name"));
    			$query->where("name","=",$name);
    			} 
if(!empty(Input::get("description"))){
	$description = str_replace("-","_",Input::get("description"));
    			$query->where("description","=",$description);
    			} 
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			} 
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			} 


    	
    	
		//$result = $query->get();
	
         
                	$result = $query->paginate(15);
           
		return $result;

    }
}

<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MyUniform extends Model
{
    
	protected $table = 'my_uniforms';
	  
	protected $fillable = [
        'id','name','number'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = MyUniform::table('MyUniform'); // it will also work , make sure table case is correct
    	$query = MyUniform::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
    			} 
if(!empty(Input::get("number"))){
    			$query->where("number","=",Input::get("number"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(2);
		//print_r($result);die();
		return $result;

    }
}

<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    
	protected $table = 'files';
	  
	protected $fillable = [
        'id','file_name','status','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => 'required','created_at' => 'required','updated_at' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = File::table('File'); // it will also work , make sure table case is correct
    	$query = File::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("file_name"))){
    			$query->where("file_name","=",Input::get("file_name"));
    			} 
if(!empty(Input::get("status"))){
    			$query->where("status","=",Input::get("status"));
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

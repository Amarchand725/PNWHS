<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    
	protected $table = 'notification';
	  
	protected $fillable = [
        'id','record_id','order_for','seen','seperate_view','title','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => 'required','record_id' => 'required','order_for' => 'required','seen' => 'required','title' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Notification::table('Notification'); // it will also work , make sure table case is correct
    	$query = Notification::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("record_id"))){
    			$query->where("record_id","=",Input::get("record_id"));
    			} 
if(!empty(Input::get("order_for"))){
    			$query->where("order_for","=",Input::get("order_for"));
    			} 
if(!empty(Input::get("seen"))){
    			$query->where("seen","=",Input::get("seen"));
    			} 
if(!empty(Input::get("seperate_view"))){
    			$query->where("seperate_view","=",Input::get("seperate_view"));
    			} 
if(!empty(Input::get("title"))){
    			$query->where("title","=",Input::get("title"));
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

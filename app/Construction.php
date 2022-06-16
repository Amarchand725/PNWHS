<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Construction extends Model
{
	protected $table = 'construction';
	  
	protected $fillable = [
        'id','constructor_id', 'category', 'plot_id', 'duaration', 'initial_price', 'status', 'price', 'final_price','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'constructor_id' => 'required', 'category' => 'required', 'plot_id' => 'required', 'duaration' => 'required', 'initial_price' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Construction::table('Construction'); // it will also work , make sure table case is correct
    	$query = Construction::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("constructor_id"))){
    			$query->where("constructor_id","=",Input::get("constructor_id"));
    			} 
if(!empty(Input::get("plot_id"))){
    			$query->where("plot_id","=",Input::get("plot_id"));
    			} 
if(!empty(Input::get("duaration"))){
    			$query->where("duaration","=",Input::get("duaration"));
    			} 
if(!empty(Input::get("initial_price"))){
    			$query->where("initial_price","=",Input::get("initial_price"));
    			} 
if(!empty(Input::get("final_price"))){
    			$query->where("final_price","=",Input::get("final_price"));
    			} 
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			} 
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(20);
		//print_r($result);die();
		return $result;

    }
}

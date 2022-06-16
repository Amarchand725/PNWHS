<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MonthlyInstalment extends Model
{
    
	protected $table = 'monthly_instalments';
	  
	protected $fillable = [
        'id','p_no','amount','paid_date','status','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'p_no' => 'required','amount' => 'required','paid_date' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = MonthlyInstalment::table('MonthlyInstalment'); // it will also work , make sure table case is correct
    	$query = MonthlyInstalment::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("amount"))){
    			$query->where("amount","=",Input::get("amount"));
    			} 
if(!empty(Input::get("paid_date"))){
    			$query->where("paid_date","=",Input::get("paid_date"));
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

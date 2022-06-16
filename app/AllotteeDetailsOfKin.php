<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllotteeDetailsOfKin extends Model
{
    
	protected $table = 'allottee_details_of_kins';
	  
	protected $fillable = [
        'id','p_no', 'name', 'relation', 'define_other', 'cnic_no', 'mobile_no', 'country_code', 'share', 'address', 'status', 'created_at','updated_at'
	];
	

	static function getValidationRules(){
    	$rules = [
		    'id' => '','application_id' => '','user_id' => '','nex_of_kin' => '','father_name_address' => '','mother_name_address' => '','present_address' => '','permanent_address' => '','status' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = AllotteeDetailsOfKin::table('AllotteeDetailsOfKin'); // it will also work , make sure table case is correct
    	$query = AllotteeDetailsOfKin::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("application_id"))){
    			$query->where("application_id","=",Input::get("application_id"));
    			} 
if(!empty(Input::get("user_id"))){
    			$query->where("user_id","=",Input::get("user_id"));
    			} 
if(!empty(Input::get("nex_of_kin"))){
    			$query->where("nex_of_kin","=",Input::get("nex_of_kin"));
    			} 
if(!empty(Input::get("father_name_address"))){
    			$query->where("father_name_address","=",Input::get("father_name_address"));
    			} 
if(!empty(Input::get("mother_name_address"))){
    			$query->where("mother_name_address","=",Input::get("mother_name_address"));
    			} 
if(!empty(Input::get("present_address"))){
    			$query->where("present_address","=",Input::get("present_address"));
    			} 
if(!empty(Input::get("permanent_address"))){
    			$query->where("permanent_address","=",Input::get("permanent_address"));
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

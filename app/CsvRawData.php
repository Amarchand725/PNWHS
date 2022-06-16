<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CsvRawData extends Model
{
    
	protected $table = 'csv_raw_data';
	  
    protected $guarded = [];

	static function getValidationRules(){
    	$rules = [
		    'csv_raw_file_id' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = CsvRawData::table('CsvRawData'); // it will also work , make sure table case is correct
    	$query = CsvRawData::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
				} 
				if(!empty(Input::get("raw_file_id"))){
					$query->where("raw_file_id","=",Input::get("raw_file_id"));
					} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("rank"))){
    			$query->where("rank","=",Input::get("rank"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
    			} 
if(!empty(Input::get("submitted_amount"))){
    			$query->where("submitted_amount","=",Input::get("submitted_amount"));
    			} 
if(!empty(Input::get("date"))){
    			$query->where("date","=",Input::get("date"));
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

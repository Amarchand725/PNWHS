<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CsvData extends Model
{
    
	protected $table = 'csv_data';
	  
	protected $fillable = [
        'id','csv_file_id','is_member','is_confleted','p_no', 'reg_fee','insurance_payment', 'rank', 'name','amount','month','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = CsvData::table('CsvData'); // it will also work , make sure table case is correct
    	$query = CsvData::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("csv_file_id"))){
    			$query->where("csv_file_id","=",Input::get("csv_file_id"));
    			} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("deducted_amount"))){
    			$query->where("deducted_amount","=",Input::get("deducted_amount"));
    			} 
if(!empty(Input::get("deducted_date"))){
    			$query->where("deducted_date","=",Input::get("deducted_date"));
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
	
	public function hasMember()
	{
		return $this->hasOne(AllotteeParticular::class, 'p_no', 'p_no');
	}
}
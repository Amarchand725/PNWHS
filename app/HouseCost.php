<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HouseCost extends Model
{
    
	protected $table = 'house_cost';
	  
	protected $fillable = [
        'id','initial_cost', 'category_id', 'created_by','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'initial_cost' => 'required', 'category_id' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = HouseCost::table('HouseCost'); // it will also work , make sure table case is correct
    	$query = HouseCost::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("initial_cost"))){
    			$query->where("initial_cost","=",Input::get("initial_cost"));
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
	
	public function hasCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function hasHouseCat()
	{
		return $this->hasOne(HouseCategory::class, 'id', 'category_id');
	}
}
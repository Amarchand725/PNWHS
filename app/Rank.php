<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rank extends Model
{
    
	protected $table = 'ranks';
	  
	protected $fillable = [
        'id','name', 'category', 'status','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'name' => 'required', 'category' => 'required'
		];
		return $rules;
    }
    
    public function hasHouseCategory()
    {
        return $this->hasOne(HouseCategory::class, 'id', 'category');
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Rank::table('Rank'); // it will also work , make sure table case is correct
    	$query = Rank::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
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
	
	public function hasPolicy()
	{
		return $this->belongsTo(PaymentPolicyData::class, 'id', 'rank_id');
	}

	public function hasCategory()
	{
		return $this->hasOne(HouseCategory::class, 'id', 'category');
	}
}

<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberProfit extends Model
{
    
	protected $table = 'members_profit';
	  
	protected $fillable = [
        'id','rate','effected_date','status','created_by','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'rate' => 'required','effected_date' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = MemberProfit::table('MemberProfit'); // it will also work , make sure table case is correct
    	$query = MemberProfit::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("rate"))){
    			$query->where("rate","=",Input::get("rate"));
    			} 
if(!empty(Input::get("effected_date"))){
    			$query->where("effected_date","=",Input::get("effected_date"));
    			} 
if(!empty(Input::get("status"))){
    			$query->where("status","=",Input::get("status"));
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
	
	public function hasUserCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}
}
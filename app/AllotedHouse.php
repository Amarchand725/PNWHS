<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllotedHouse extends Model
{
    
	protected $table = 'alloted_houses';
	  
	protected $fillable = [
        'id','p_no','allocated_house','allocated_account_of','house_dues_instalment','created_by','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'allocated_house' => 'required','allocated_account_of' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = AllotedHouse::table('AllotedHouse'); // it will also work , make sure table case is correct
    	$query = AllotedHouse::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("allocated_house"))){
    			$query->where("allocated_house","=",Input::get("allocated_house"));
    			} 
if(!empty(Input::get("allocated_account_of"))){
    			$query->where("allocated_account_of","=",Input::get("allocated_account_of"));
    			} 
if(!empty(Input::get("house_dues_instalment"))){
    			$query->where("house_dues_instalment","=",Input::get("house_dues_instalment"));
    			} 
if(!empty(Input::get("allocated_by"))){
    			$query->where("allocated_by","=",Input::get("allocated_by"));
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
	
	public function hasUser()
	{
		return $this->hasOne(AllotteeParticular::class, 'p_no', 'p_no');
	}

	public function hasHouse()
	{
		return $this->hasOne(Plot::class, 'id', 'allocated_house');
	}

	public function hasPayment()
	{
		return $this->hasMany(Payment::class, 'p_no', 'p_no');
	}
}
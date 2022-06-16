<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentPolicy extends Model
{
	protected $table = 'payment_policies';
	  
	protected $fillable = [
        'id','rank_id', 'created_by', 'effective_date', 'expire_date' ,'cat_id', 'registration_payment','monthly_instalment', 'insurance_payment', 'effective_date', 'status', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'insurance_payment' => 'required', 'registration_payment' => 'required','monthly_instalment' => 'required','effective_date' => 'required'
		];
		return $rules;
	}
	
	static function Search(){
		$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
		//$query = PaymentPolicy::table('PaymentPolicy'); // it will also work , make sure table case is correct
		$query = PaymentPolicy::where('id','>',0);

			if(!empty(Input::get("id"))){
				$query->where("id","=",Input::get("id"));
				} 
			if(!empty(Input::get("rank_id"))){
				$query->where("rank_id","=",Input::get("rank_id"));
				} 
			if(!empty(Input::get("registration_payment"))){
				$query->where("registration_payment","=",Input::get("registration_payment"));
				} 
			if(!empty(Input::get("monthly_instalment"))){
				$query->where("monthly_instalment","=",Input::get("monthly_instalment"));
				} 
			if(!empty(Input::get("effective_date"))){
				$query->where("effective_date","=",Input::get("effective_date"));
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
	
	public function hasRank()
	{
		return $this->hasOne(Rank::class, 'id', 'rank_id');
	}

	public function hasHouseCat()
	{
		return $this->hasOne(HouseCategory::class, 'id', 'cat_id');
	}

	public function hasUserCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function hasPolicyAppliedRanks()
	{
		return $this->hasMany(PaymentPolicyData::class, 'payment_policy_id');
	}
}

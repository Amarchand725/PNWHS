<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromotedMember extends Model
{
    
	protected $table = 'promoted_members';
	  
	protected $fillable = [
        'id','created_by', 'promoted_rank_id', 'file_registration_no', 'old_p_no','new_p_no', 'soldier', 'd_o_p', 'd_o_sod', 'd_o_sos', 'd_o_s', 'gross_salary', 'total_service', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'promoted_rank_id' => 'required', 'file_registration_no' => 'required', 'old_p_no' => 'required','new_p_no' => 'required','d_o_p' => 'required', 'd_o_sod' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = PromotedMember::table('PromotedMember'); // it will also work , make sure table case is correct
    	$query = PromotedMember::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("created_by"))){
    			$query->where("created_by","=",Input::get("created_by"));
    			} 
if(!empty(Input::get("old_p_no"))){
    			$query->where("old_p_no","=",Input::get("old_p_no"));
    			} 
if(!empty(Input::get("new_p_no"))){
    			$query->where("new_p_no","=",Input::get("new_p_no"));
    			} 
if(!empty(Input::get("promoted_rank_id"))){
    			$query->where("promoted_rank_id","=",Input::get("promoted_rank_id"));
    			} 
if(!empty(Input::get("promoted_date"))){
    			$query->where("promoted_date","=",Input::get("promoted_date"));
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
	
	public function hasPromotedRank()
	{
		return $this->hasOne(Rank::class, 'id', 'promoted_rank_id');
	}
	
	public function hasUserCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}
	
	public function hasMember()
	{
		return $this->hasOne(AllotteeParticular::class, 'p_no', 'old_p_no');
	}
}
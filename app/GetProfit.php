<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GetProfit extends Model
{
    
	protected $table = 'get_profits';
	  
	protected $fillable = [
		'id','profit_rate_id','p_no','account_of','paid_amount','profit_amount','total_amount', 'payment_status', 
		'payment_method', 'ref_cheque_no', 'bank_name', 'date', 'reciever_name', 'reciever_cnic', 'remarks', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = GetProfit::table('GetProfit'); // it will also work , make sure table case is correct
    	$query = GetProfit::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("profit_rate_id"))){
    			$query->where("profit_rate_id","=",Input::get("profit_rate_id"));
    			} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("account_of"))){
    			$query->where("account_of","=",Input::get("account_of"));
    			} 
if(!empty(Input::get("paid_amount"))){
    			$query->where("paid_amount","=",Input::get("paid_amount"));
    			} 
if(!empty(Input::get("profit_amount"))){
    			$query->where("profit_amount","=",Input::get("profit_amount"));
    			} 
if(!empty(Input::get("total_amount"))){
    			$query->where("total_amount","=",Input::get("total_amount"));
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
	
	public function hasProfitRate()
	{
		return $this->hasOne(MemberProfit::class, 'id', 'profit_rate_id');
	}

	public function hasPromotedMember()
	{
		return $this->hasOne(PromotedMember::class, 'new_p_no', 'p_no')->orderby('id', 'DESC');
	}

	public function hasMember()
	{
		return $this->hasOne(AllotteeParticular::class, 'p_no', 'p_no');
	}
}
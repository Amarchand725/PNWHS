<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{

	protected $table = 'payment';

	protected $fillable = [
        'id','p_no', 'member_id', 'policy_id', 'voucher_no', 'slip_no', 'payment_type', 'reg_insu_fee', 'total_amount', 'sub_monthly_install', 'submitted_amount', 'current_paid', 'amount', 'bank_name', 'deposit_date', 'instrument_no', 'remarks', 'is_active','plot_no','payment_status', 'month','amount_type','amountts','Payment','year','booking','monthly_installments','half_yearly_installments','possession','amounts','created_by','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','p_no' => '','amount' => '','created_by' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }


        // public function users(){
        //    return $this->belongsTo(Users::class);
        // }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Payment::table('Payment'); // it will also work , make sure table case is correct
    	$query = Payment::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			}
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			}
if(!empty(Input::get("amount_type"))){
    			$query->where("amount_type","=",Input::get("amount_type"));
    			}
if(!empty(Input::get("month"))){
    			$query->where("month","=",Input::get("month"));
    			}
if(!empty(Input::get("amount"))){
    			$query->where("amount","=",Input::get("amount"));
    			}
if(!empty(Input::get("year"))){
    			$query->where("year","=",Input::get("year"));
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
	
	public function hasMember()
	{
		return $this->hasOne(AllotteeParticular::class, 'id', 'member_id');
	}

	public function hasHouse()
	{
		return $this->hasOne(Plot::class, 'id', 'plot_no');
	}
	
	public function hasPromotedMember()
	{
		return $this->hasOne(PromotedMember::class, 'member_id', 'member_id')->orderby('id', 'DESC');
	}
}
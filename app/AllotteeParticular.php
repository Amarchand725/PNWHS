<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllotteeParticular extends Model
{

	protected $table = 'allottee_particulars';

	protected $fillable = [
		'id','original_p_no', 'user_id', 'reg_file_no', 'membership_date', 'created_by','image','salary', 'any_other_benifit', 'membersip_id','booking','membership_id','pendingamount','possession','memberpaidamount','p_no', 'honu_p_no', 'title','seperate_view','seen','transactionform2','name','rank_rate', 'soldier', 'cnic_no','d_o_b', 'd_o_e','branch','d_o_c','d_o_p','d_o_sod','d_o_sos','total_service','d_o_s','tel_no','mob_no','email_address', 'permanent_address', 'present_address', 'unit','status', 'remarks_status', 'created', 'form_status', 'is_deleted', 'created_at','update_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'p_no' => 'required', 'membership_date' => 'required', 'rank_rate' => 'required', 'name' => 'required', 'cnic_no' => 'required', 'branch' => 'required','total_service' => 'required', 'mob_no' => 'required'
		];
		return $rules;
	}
	
	// public function hasAssignedPolicy()
	// {
	// 	return $this->hasOne(AssignedPolicy::class, 'p_no', 'p_no')->orderby('id', 'DESC');
	// }

public function Scopegetcount($query){
$datas =  $query->orderBy('id','desc')->first();
if(!empty($datas)){
	return $datas->id;
}
else{
	return 0;
}
}
//update statusof application

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = AllotteeParticular::table('AllotteeParticular'); // it will also work , make sure table case is correct
    	$query = AllotteeParticular::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			}
if(!empty(Input::get("user_id"))){
    			$query->where("user_id","=",Input::get("user_id"));
    			}
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","like", "%".Input::get("p_no")."%");
    			}
if(!empty(Input::get("name"))){
    			$query->where("name","like","%".Input::get("name")."%");
    			}
if(!empty(Input::get("rank_rate"))){
    			$query->where("rank_rate","=",Input::get("rank_rate"));
    			}
if(!empty(Input::get("cnic_no"))){
    			$query->where("cnic_no","=",Input::get("cnic_no"));
    			}
if(!empty(Input::get("d_o_b"))){
    			$query->where("d_o_b","=",Input::get("d_o_b"));
    			}
if(!empty(Input::get("father_name"))){
    			$query->where("father_name","=",Input::get("father_name"));
    			}
if(!empty(Input::get("d_o_e"))){
    			$query->where("d_o_e","=",Input::get("d_o_e"));
    			}
if(!empty(Input::get("branch"))){
    			$query->where("branch","=",Input::get("branch"));
    			}
if(!empty(Input::get("d_o_c"))){
    			$query->where("d_o_c","=",Input::get("d_o_c"));
    			}
if(!empty(Input::get("d_o_p"))){
    			$query->where("d_o_p","=",Input::get("d_o_p"));
    			}
if(!empty(Input::get("d_o_sod"))){
    			$query->where("d_o_sod","=",Input::get("d_o_sod"));
    			}
if(!empty(Input::get("d_o_sos"))){
    			$query->where("d_o_sos","=",Input::get("d_o_sos"));
    			}
if(!empty(Input::get("total_service"))){
    			$query->where("total_service","=",Input::get("total_service"));
    			}
if(!empty(Input::get("d_o_s"))){
    			$query->where("d_o_s","=",Input::get("d_o_s"));
    			}
if(!empty(Input::get("tel_no"))){
    			$query->where("tel_no","=",Input::get("tel_no"));
    			}
if(!empty(Input::get("mob_no"))){
    			$query->where("mob_no","=",Input::get("mob_no"));
    			}
if(!empty(Input::get("email_address"))){
    			$query->where("email_address","=",Input::get("email_address"));
    			}
if(!empty(Input::get("status"))){
    			$query->where("status","=",Input::get("status"));
    			}
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			}
if(!empty(Input::get("update_at"))){
    			$query->where("update_at","=",Input::get("update_at"));
    			}
		//$result = $query->get();
		$result = $query->where('form_status', 0)->paginate(10);
		// print_r($result);die();
		return $result;
	}

	public function hasPromoted()
	{
		return $this->hasMany(PromotedMember::class, 'old_p_no', 'p_no')->orderby('d_o_p', 'DESC');
	}
	
	public function hasUser()
	{
		return $this->hasOne(User::class, 'p_no', 'p_no');
	}

	public function hasRank()
	{
		return $this->belongsTo(Rank::class, 'rank_rate', 'id');
	}

	// public function hasPayment()
	// {
	// 	return $this->hasMany(Payment::class, 'p_no', 'p_no');
	// }

	public function hasMemberStatus()
	{
		return $this->hasOne(Payment::class, 'p_no', 'p_no')->orderby('id', 'DESC');
	}

	public function hasAllotedHouse()
	{
		return $this->hasOne(AllotedHouse::class, 'p_no', 'p_no');
	}

	public function hasWife()
	{
		return $this->hasMany(UserWife::class, 'p_no', 'p_no');
	}

	public function hasChild()
	{
		return $this->hasMany(UserChild::class, 'p_no', 'p_no');
	}

	public function hasMade()
	{
		return $this->hasMany(UserMade::class, 'p_no', 'p_no');
	}

	public function hasDriver()
	{
		return $this->hasMany(UserDriver::class, 'p_no', 'p_no');
	}

	public function hasChef()
	{
		return $this->hasMany(UserChef::class, 'p_no', 'p_no');
	}

	public function hasGardener()
	{
		return $this->hasMany(UserGardener::class, 'p_no', 'p_no');
	}

	public function hasAllotteKinDetails()
	{
		return $this->hasMany(AllotteeDetailsOfKin::class, 'p_no', 'original_p_no');
	}

	public function hasAllotteeFiles()
	{
		return $this->hasOne(Alloteefiles::class, 'p_no', 'p_no');
	}

	public function hasAllotteeKinsMultipleFiles()
	{
		return $this->hasMany(Kinsmultiplefile::class, 'p_no', 'p_no');
	}

	public function hasPayment()
	{
		return $this->hasOne(Payment::class, 'p_no', 'p_no')->orderby('id', 'DESC');
	}
	
	public function hasMemberPaidAmount()
	{
		return $this->hasMany(Payment::class, 'p_no', 'p_no')->orderby('id', 'DESC');
	}
	
	public function hasPromotedMember()
	{
		return $this->hasOne(PromotedMember::class, 'new_p_no', 'p_no')->orderby('id', 'DESC');
	}
}
<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class House_alloted_details extends Model
{
    
	protected $table = 'house_alloted_details';
	  
	protected $fillable = [
        'id','user_id','p_no','title','name','rank_rate','cnic_no','d_o_b','father_name_particular','d_o_e','branch','d_o_c','d_o_p','d_o_sod','d_o_sos','total_service','d_o_s','tel_no','mob_no','email_address','salary','date','unit','wife_name','wife_cnic','wife_security_clearance','wife_blacklist','total_childs','child_name','child_b_form','child_age','child_gender','child_security_clearance','child_blacklist','made_name','made_cnic','made_mobile','made_security_clearance','made_blacklist','driver_name','driver_cnic','driver_mobile','driver_clearance','driver_blacklist','guard_name','guard_cnic','guard_mobile','guard_security_clearance','guard_blacklist','chef_name','chef_cnic','chef_mobile','chef_security_clearance','chef_blacklist','gardener_name','gardener_cnic','gardener_mobile','gardener_security_gardener','gardener_blacklist','status','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => 'required','user_id' => 'required','title' => 'required','date' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = House_alloted_details::table('House_alloted_details'); // it will also work , make sure table case is correct
    	$query = House_alloted_details::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("user_id"))){
    			$query->where("user_id","=",Input::get("user_id"));
    			} 
if(!empty(Input::get("p_no"))){
    			$query->where("p_no","=",Input::get("p_no"));
    			} 
if(!empty(Input::get("title"))){
    			$query->where("title","=",Input::get("title"));
    			} 
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
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
if(!empty(Input::get("father_name_particular"))){
    			$query->where("father_name_particular","=",Input::get("father_name_particular"));
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
if(!empty(Input::get("salary"))){
    			$query->where("salary","=",Input::get("salary"));
    			} 
if(!empty(Input::get("date"))){
    			$query->where("date","=",Input::get("date"));
    			} 
if(!empty(Input::get("unit"))){
    			$query->where("unit","=",Input::get("unit"));
    			} 
if(!empty(Input::get("wife_name"))){
    			$query->where("wife_name","=",Input::get("wife_name"));
    			} 
if(!empty(Input::get("wife_cnic"))){
    			$query->where("wife_cnic","=",Input::get("wife_cnic"));
    			} 
if(!empty(Input::get("wife_security_clearance"))){
    			$query->where("wife_security_clearance","=",Input::get("wife_security_clearance"));
    			} 
if(!empty(Input::get("wife_blacklist"))){
    			$query->where("wife_blacklist","=",Input::get("wife_blacklist"));
    			} 
if(!empty(Input::get("total_childs"))){
    			$query->where("total_childs","=",Input::get("total_childs"));
    			} 
if(!empty(Input::get("child_name"))){
    			$query->where("child_name","=",Input::get("child_name"));
    			} 
if(!empty(Input::get("child_b_form"))){
    			$query->where("child_b_form","=",Input::get("child_b_form"));
    			} 
if(!empty(Input::get("child_age"))){
    			$query->where("child_age","=",Input::get("child_age"));
    			} 
if(!empty(Input::get("child_gender"))){
    			$query->where("child_gender","=",Input::get("child_gender"));
    			} 
if(!empty(Input::get("child_security_clearance"))){
    			$query->where("child_security_clearance","=",Input::get("child_security_clearance"));
    			} 
if(!empty(Input::get("child_blacklist"))){
    			$query->where("child_blacklist","=",Input::get("child_blacklist"));
    			} 
if(!empty(Input::get("made_name"))){
    			$query->where("made_name","=",Input::get("made_name"));
    			} 
if(!empty(Input::get("made_cnic"))){
    			$query->where("made_cnic","=",Input::get("made_cnic"));
    			} 
if(!empty(Input::get("made_mobile"))){
    			$query->where("made_mobile","=",Input::get("made_mobile"));
    			} 
if(!empty(Input::get("made_security_clearance"))){
    			$query->where("made_security_clearance","=",Input::get("made_security_clearance"));
    			} 
if(!empty(Input::get("made_blacklist"))){
    			$query->where("made_blacklist","=",Input::get("made_blacklist"));
    			} 
if(!empty(Input::get("driver_name"))){
    			$query->where("driver_name","=",Input::get("driver_name"));
    			} 
if(!empty(Input::get("driver_cnic"))){
    			$query->where("driver_cnic","=",Input::get("driver_cnic"));
    			} 
if(!empty(Input::get("driver_mobile"))){
    			$query->where("driver_mobile","=",Input::get("driver_mobile"));
    			} 
if(!empty(Input::get("driver_clearance"))){
    			$query->where("driver_clearance","=",Input::get("driver_clearance"));
    			} 
if(!empty(Input::get("driver_blacklist"))){
    			$query->where("driver_blacklist","=",Input::get("driver_blacklist"));
    			} 
if(!empty(Input::get("guard_name"))){
    			$query->where("guard_name","=",Input::get("guard_name"));
    			} 
if(!empty(Input::get("guard_cnic"))){
    			$query->where("guard_cnic","=",Input::get("guard_cnic"));
    			} 
if(!empty(Input::get("guard_mobile"))){
    			$query->where("guard_mobile","=",Input::get("guard_mobile"));
    			} 
if(!empty(Input::get("guard_security_clearance"))){
    			$query->where("guard_security_clearance","=",Input::get("guard_security_clearance"));
    			} 
if(!empty(Input::get("guard_blacklist"))){
    			$query->where("guard_blacklist","=",Input::get("guard_blacklist"));
    			} 
if(!empty(Input::get("chef_name"))){
    			$query->where("chef_name","=",Input::get("chef_name"));
    			} 
if(!empty(Input::get("chef_cnic"))){
    			$query->where("chef_cnic","=",Input::get("chef_cnic"));
    			} 
if(!empty(Input::get("chef_mobile"))){
    			$query->where("chef_mobile","=",Input::get("chef_mobile"));
    			} 
if(!empty(Input::get("chef_security_clearance"))){
    			$query->where("chef_security_clearance","=",Input::get("chef_security_clearance"));
    			} 
if(!empty(Input::get("chef_blacklist"))){
    			$query->where("chef_blacklist","=",Input::get("chef_blacklist"));
    			} 
if(!empty(Input::get("gardener_name"))){
    			$query->where("gardener_name","=",Input::get("gardener_name"));
    			} 
if(!empty(Input::get("gardener_cnic"))){
    			$query->where("gardener_cnic","=",Input::get("gardener_cnic"));
    			} 
if(!empty(Input::get("gardener_mobile"))){
    			$query->where("gardener_mobile","=",Input::get("gardener_mobile"));
    			} 
if(!empty(Input::get("gardener_security_gardener"))){
    			$query->where("gardener_security_gardener","=",Input::get("gardener_security_gardener"));
    			} 
if(!empty(Input::get("gardener_blacklist"))){
    			$query->where("gardener_blacklist","=",Input::get("gardener_blacklist"));
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
}

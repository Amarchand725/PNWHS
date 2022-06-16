<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kinsmultiplefile extends Model
{

	protected $table = 'kinsmulltiplefiles';

	protected $fillable = [
        'id', 'p_no', 'application_id','alloteefiles_id','fileposition','filetext', 'status', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','application_id' => '','user_id' => '','nex_of_kin' => '','father_name_address' => '','mother_name_address' => '','present_address' => '','permanent_address' => '','status' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

}

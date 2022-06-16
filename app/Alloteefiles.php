<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alloteefiles extends Model
{

	protected $table = 'allottee_files';

	protected $fillable = [
        'id', 'p_no', 'user_id','application_id','cnicfront','cnicback','childrenbform', 'promotion_letter', 'fpaform','applicant_photograph', 'frp_fc', 'draft_cheque', 'any_other_docs', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','application_id' => '','user_id' => '','nex_of_kin' => '','father_name_address' => '','mother_name_address' => '','present_address' => '','permanent_address' => '','status' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

    public function alloteefiles(){
        return $this->hasMany(Kinsmultiplefile::class);
    }

}

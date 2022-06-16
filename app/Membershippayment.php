<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Membershippayment extends Model
{
    
	protected $table = 'membershippayment';
	  
	protected $fillable = [
        'id','mpayment', 'm_rank', 'effective_date'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Membershippayment::table('Membershippayment'); // it will also work , make sure table case is correct
    	$query = Membershippayment::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("mpayment"))){
    			$query->where("mpayment","=",Input::get("mpayment"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(10);
		//print_r($result);die();
		return $result;

    }
}

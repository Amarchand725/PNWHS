<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class oauth_refresh_tokens extends Model
{
    
	protected $table = 'oauth_refresh_tokens';
	  
	protected $fillable = [
        'id','access_token_id','revoked','expires_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => 'required','access_token_id' => 'required','revoked' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = oauth_refresh_tokens::table('oauth_refresh_tokens'); // it will also work , make sure table case is correct
    	$query = oauth_refresh_tokens::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("access_token_id"))){
    			$query->where("access_token_id","=",Input::get("access_token_id"));
    			} 
if(!empty(Input::get("revoked"))){
    			$query->where("revoked","=",Input::get("revoked"));
    			} 
if(!empty(Input::get("expires_at"))){
    			$query->where("expires_at","=",Input::get("expires_at"));
    			} 


    	
    	
		//$result = $query->get();
		$result = $query->paginate(2);
		//print_r($result);die();
		return $result;

    }
}

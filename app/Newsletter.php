<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Newsletter extends Model
{

	protected $table = 'newsletter';

	protected $fillable = [
        'id','user_id','subject','title','is_active','newsletterfile','expiry_date','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','user_id' => '','title' => 'required','newsletterfile' => 'required','expiry_date' => '','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Newsletter::table('Newsletter'); // it will also work , make sure table case is correct
    	$query = Newsletter::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			}
if(!empty(Input::get("user_id"))){
    			$query->where("user_id","=",Input::get("user_id"));
    			}
if(!empty(Input::get("subject"))){
    			$query->where("subject","=",Input::get("subject"));
    			}
if(!empty(Input::get("title"))){
    			$query->where("title","=",Input::get("title"));
    			}
if(!empty(Input::get("file"))){
    			$query->where("file","=",Input::get("file"));
    			}
if(!empty(Input::get("expiry_date"))){
    			$query->where("expiry_date","=",Input::get("expiry_date"));
    			}
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			}
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			}




		//$result = $query->get();
		$result = $query->paginate(10);
		//print_r($result);die();
		return $result;

    }
}

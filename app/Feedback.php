<?php
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Feedback extends Model
{

	protected $table = 'feedback';

	protected $fillable = [
        'id','title','user_id','description','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'id' => '','title' => 'required','description' => 'required','created_at' => '','updated_at' => ''
		];
		return $rules;
    }

//User many feed back
    public function user(){
       // return 'testing';
       return  $this->hasMany('App\Users');
    }

		static function Search($usertype){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Feedback::table('Feedback'); // it will also work , make sure table case is correct
    	$query = Feedback::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
                }
                if($usertype != 'user'){
                    if(!empty(Input::get("title"))){

                        $query->where("title","=",Input::get("title"));
                        }
                }
                if($usertype == 'user'){
                    if(!empty(Input::get("title"))){

                        $query->where("title","=",Input::get("title",'user_id',Auth::id()));
                        }
                }

if(!empty(Input::get("description"))){
    			$query->where("description","=",Input::get("description"));
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

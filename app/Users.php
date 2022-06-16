<?php
namespace App;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{

	protected $table = 'users';

	protected $fillable = [
        'id', 'role', 'user_type', 'created_by', 'p_no', 'name', 'cell', 'email','password','remember_token', 'is_active', 'created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
            'email' => 'required',
            'name' => 'required',
            'role' => 'required',
            'user_type' => 'required'
        ];
		return $rules;
    }

	public function userType(){
        return $this->hasOne(UserType::class,'id','user_type')->withDefault([
            'name' => 'N/A'
        ]);
    }
	
	public function hasUserCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}
	
	public function hasRole()
	{
		return $this->hasOne(Userroles::class, 'id', 'role');
	}

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Users::table('Users'); // it will also work , make sure table case is correct
    	$query = Users::where('user_type','!=',null);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			}
if(!empty(Input::get("name"))){
    			$query->where("name","=",Input::get("name"));
    			}
if(!empty(Input::get("email"))){
    			$query->where("email","=",Input::get("email"));
    			}
if(!empty(Input::get("password"))){
    			$query->where("password","=",Input::get("password"));
    			}
if(!empty(Input::get("remember_token"))){
    			$query->where("remember_token","=",Input::get("remember_token"));
    			}
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			}
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			}
            if(!empty(Input::get("user_type"))){
                $query->where("user_type","=",Input::get("user_type"));
            }


                		$result = $query->paginate(10);


		return $result;

    }
}

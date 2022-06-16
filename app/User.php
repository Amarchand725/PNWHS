<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email', 
        'password',
        'mobile_no',
        'user_type',
        'created_by',
        'user_of',
        'phone',
        'city',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType(){
        return $this->hasOne('App\UserType','id','user_type');
    }

     static function Search(){
        $pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
        //$query = Transition::table('Transition'); // it will also work , make sure table case is correct
        $query = User::where('id','>',0);

        if(!empty(Input::get("id"))){
            $query->where("id","=",Input::get("id"));
        }
        if(!empty(Input::get("email"))){
            $query->where("email","=",Input::get("email"));
        }
        if(!empty(Input::get("user_type"))){
            $query->where("user_type","=",Input::get("user_type"));
        }


        //$result = $query->get();
        $result = $query->paginate(10);
        //print_r($result);die();
        return $result;
    }

    public function hasRole()
    {
        return $this->hasOne(Userroles::class, 'id', 'role');
    }
}
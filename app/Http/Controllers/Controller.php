<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Auth;

class Controller extends BaseController
{
    public function getpermission($permissionkey){
        $usersdata =  DB::table('userroles')->where('id',Auth::user()->role)->first();
        if(!empty($usersdata)){
          $userrightsjson =  json_decode($usersdata->rights);
        }
        else{
            $dummyarray = array();
          $userrightsjson =$dummyarray;
        }
        
        if(in_array($permissionkey, $userrightsjson)){ 
            return  'true';
    }
    else{
            return 'false';
    }
}

//Get Active data
public function checkactive($active){
  if($active == 1){
    return 'Active';
  }
  else if($active == 0){
    return 'DeActive';
  }
}

function gettypenumber($n) {
  // first strip any formatting;
  $n = (0+str_replace(",", "", $n));

  // is this a number?
  if (!is_numeric($n)) return false;

  // now filter it;
  if ($n > 1000000000000) return round(($n/1000000), 2).' M';
  elseif ($n > 1000000000) return round(($n/1000000), 2).' M';
  elseif ($n > 1000000) return round(($n/1000000), 2).' M';
  elseif ($n > 1000) return round(($n/1000000), 2).' M';

  return number_format($n);
}
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}

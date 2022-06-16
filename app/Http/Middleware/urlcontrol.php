<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
Use DB;
class urlcontrol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userrole = Auth::user()->role;
       $datarole =  DB::table('userroles')->select('rights')->where('id',$userrole)->first();
       $jsondata =  json_decode($datarole->rights);
       $parameters1 = \Request::segment(2);
       $parameters='';
       $peramdata='';
    $editvar =   \Request::segment(3);
    

      if($editvar == 'edit'){
       if(is_numeric ($parameters1)){
        $parameters = \Request::segment(3);
       }
    }
    else if(!empty(\Request::segment(1)) && is_numeric (\Request::segment(2)) && empty(\Request::segment(3))) {
        $parameters =   \Request::segment(1);
        $jsondata[0] = 'AllotteeDetailsOfKin';
    }
    else if(!empty(\Request::segment(1)) && empty(\Request::segment(2)) ){
        $parameters =   \Request::segment(1);
        $jsondata[0] = 'AllotteeDetailsOfKin';
    }
       else{
        $parameters = \Request::segment(2);
       }
      if(!empty($jsondata[1])){
       if($jsondata[1] == 'Application_insert'){
        $jsondata[1] = 'create1';
       }
    }
  
    if(!empty($jsondata[2])){
       if($jsondata[2] == 'Application_update'){
        $jsondata[2] = 'edit';
       }
    }
   if(in_array($parameters,$jsondata)){
   return $next($request);
}
else{
    return redirect('/');
} 



       
    }
}

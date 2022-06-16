<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
Use DB;
class usermanagement
{
    
    public function handle($request, Closure $next)
    {
        $userrole = Auth::user()->role;
       $datarole =  DB::table('userroles')->select('rights')->where('id',$userrole)->first();
       $jsondata =  json_decode($datarole->rights);
       
      
       if(in_array('Users',$jsondata)){
          $jsondata[] = 'Userpermission'; 
       }
       if(in_array('Users',$jsondata)){
          $jsondata[] = 'Userroles'; 
       }
       $parameters = \Request::segment(1);
       $parameterss = str_replace("_"," ",$parameters);
       $peramdata='';
      $strcount =  strlen($parameterss);

      if($strcount == 2){
       $peramdata = strtoupper($parameterss);
      }
      else{
        $peramdata =  ucwords($parameterss);
      }
      
   if(in_array($peramdata,$jsondata)){
   return $next($request);
}
else{
    return redirect('/');
} 
    }
}

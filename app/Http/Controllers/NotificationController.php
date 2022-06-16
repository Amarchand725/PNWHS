<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Notification;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Notification::Search();
        }else{
             $user_type = Auth::user()->user_type;
            if ( $user_type == 1) {
                $models =  DB::table('notification')->orderBy('id','desc limit 10')->paginate(30);
            }
            else if( $user_type == 2){
                $models =   DB::table('notification')->where('notif_for',Auth::id())->orderBy('id','desc limit 10')->paginate(30);
            }
            else if( $user_type == 3){
                 $models  = DB::table('notification')->where('notif_for',Auth::id())->orderBy('id','desc limit 10')->paginate(30);

            }
        }
        
                
        if (\Request::ajax()) {

            return view('notification.ajax',  compact('models'));
        }

    	
        return view('notification.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Notification::getValidationRules());

        $input = $request->all();
	    Notification::create($input);

	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        $model = Notification::findOrFail($id);
       
      	return view('notification.show', array('model' => $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
         $model = Notification::findOrFail($id);

    return view('notification.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //
       $model = Notification::findOrFail($id);

	    $this->validate($request, Notification::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Notification successfully updated!');

	    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $model = Notification::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Notification successfully deleted!');

	    return redirect()->route('notification.index');
    }

    // public function readNotif($id){
    //     echo "aaa"; die();
    //     //return $id;
    //     $notifaction = Notification::findOrFail($request->notf_id);
    //     $user_id = Auth::id(); 
    //     $user = DB::table('users')->where('id', $user_id)->first();
    //     $user_type = Auth::user()->user_type;
    //     if ($user_type == 1) {
    //         DB::table('notification')->where('record_id',  $request->record_id)where('id',$request->notf_id)->update(['admin_seen' => 1]);
    //     }
    //     else if($user_type == 2){
    //         DB::table('notification')->where('record_id', $request->record_id)where('id',$request->notf_id)->where('notif_for', Auth::id())->update(['seen' => 1]);
    //     }
    //      else if($user_type == 3){
    //         DB::table('notification')->where('record_id', $request->record_id)where('id',$request->notf_id)->where('notif_for', Auth::id())->update(['shop_seen' => 1]);
    //     }
    //     return response()->json(['success'=>$notifaction->seperate_view ]);

    // }
}

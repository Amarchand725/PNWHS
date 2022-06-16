<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AllotteeDetailsOfKin;
use App\Alloteefiles;
use App\Kinsmultiplefile;
use App\AllotteeParticular;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;


class AllotteeDetailsOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new AllotteeDetailsOfKin;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = AllotteeDetailsOfKin::where('is_active',1)->Search();
        }else{
           $models =  AllotteeDetailsOfKin::where('is_active',1)->paginate(2);
        }
        if (\Request::ajax()) {

            return view('allotteeDetailsOfKin.ajax',  compact('models'));
        }
        return view('allotteeDetailsOfKin.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('allotteeDetailsOfKin.create');
    }
    public function create2($id)
    {
        $application_id = $id;
        return view('allotteeParticular.create',compact('application_id'));
    }
    public function create2edit($id)
    {
        $model = DB::table('allottee_particulars as alp')
        ->select('*')
        ->join('allottee_details_of_kins as adk', 'adk.application_id', '=', 'alp.id')
       // ->join('allottee_details_service as ads', 'ads.application_id', '=', 'alp.id')
        ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
        ->join('kinsmulltiplefiles as kinmul', 'kinmul.application_id', '=', 'alp.id')
        ->where('alp.id',$id)
        ->first();
        return view('AllotteeDetailsOfKin.edit',compact('model'));
    }
    public function create3edit($id)
    {
        $model = DB::table('allottee_particulars as alp')
        ->select('*')
        ->join('allottee_details_of_kins as adk', 'adk.application_id', '=', 'alp.id')
        //->join('allottee_details_service as ads', 'ads.application_id', '=', 'alp.id')
        ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
        ->join('kinsmulltiplefiles as kinmul', 'kinmul.application_id', '=', 'alp.id')
        ->where('alp.id',$id)
        ->first();
        return view('AllotteeDetailsOfKin.edit',compact('model'));
    }
    public function create4edit($id)
    {
        $model = DB::table('allottee_particulars as alp')
        ->select('*')
        ->join('allottee_details_of_kins as adk', 'adk.application_id', '=', 'alp.id')
        //->join('allottee_details_service as ads', 'ads.application_id', '=', 'alp.id')
        ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
        ->join('kinsmulltiplefiles as kinmul', 'kinmul.application_id', '=', 'alp.id')
        ->where('alp.id',$id)
        ->first();
        return view('AllotteeDetailsOfKin.edit',compact('model'));
    }
    public function create3($id)
    {
        $application_id = $id;
        //echo $id; die;
        return view('allotteeParticular.create',compact('application_id'));
        // $application_id = $id;
        // return view('allotteeParticular.create',compact('application_id'));
    }
    public function create4($id)
    {
        $application_id = $id;
        return view('allotteeParticular.create',compact('application_id'));
    }


//Uploads Filez
    public function uploadfiles(Request $request){
        $input = $request->all();
        $cnicfront = '';

        if ($request->hasFile('cnicfront')) {
            $filecnicfront = $request->file('cnicfront');
            if(!empty($filecnicfront)){
             $imagestring = str_replace(' ', '', $filecnicfront->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('alloteefiles');
            if($filecnicfront->move($destinationPath, $fileName)){
                        // $temp[] = $fileName;
            }
                 $cnicfront =  $fileName;
            }else{
                $cnicfront = '';
            }
        }
        //Add Cnicn Back
        $cnicback = '';
        $input = $request->all();
        if ($request->hasFile('cnicback')) {
            $filecnicback = $request->file('cnicback');
            if(!empty($filecnicback)){
             $imagestring = str_replace(' ', '', $filecnicback->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('alloteefiles');
            if($filecnicback->move($destinationPath, $fileName)){
                        // $temp[] = $fileName;
            }
                 $cnicback =  $fileName;
            }else{
                $cnicback = '';
            }
        }


        //Add children B form
        $childrenbform = '';
        $input = $request->all();
        if ($request->hasFile('childrenbform')) {
            $filebform = $request->file('childrenbform');
            if(!empty($filebform)){
             $imagestring = str_replace(' ', '', $filebform->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('alloteefiles');
            if($filebform->move($destinationPath, $fileName)){
                        // $temp[] = $fileName;
            }
                 $childrenbform =  $fileName;
            }else{
                $childrenbform = '';
            }
        }


        //Add fpaform
        $fpaform = '';
        $input = $request->all();
        if ($request->hasFile('fpaform')) {
            $filefpaform = $request->file('fpaform');
            if(!empty($filefpaform)){
             $imagestring = str_replace(' ', '', $filefpaform->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('alloteefiles');
            if($filefpaform->move($destinationPath, $fileName)){
                        // $temp[] = $fileName;
            }
                 $fpaform =  $fileName;
            }else{
                $fpaform = '';
            }
        }


        //Add applicant photograph
        $applicant_photograph = '';
        $input = $request->all();
        if ($request->hasFile('applicant_photograph')) {
            $file_applicant_photograph = $request->file('applicant_photograph');
            if(!empty($file_applicant_photograph)){
             $imagestring = str_replace(' ', '', $file_applicant_photograph->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('alloteefiles');
            if($file_applicant_photograph->move($destinationPath, $fileName)){
                        // $temp[] = $fileName;
            }
                 $applicant_photograph =  $fileName;
            }else{
                $applicant_photograph = '';
            }
        }



    $alloteefiles =  Alloteefiles::create(
            [
                'application_id' => $input['application_id'],
                'user_id' => Auth::id(),
                'cnicfront' => $cnicfront,
                'cnicback' => $cnicback,
                'childrenbform' => $childrenbform,
                'fpaform' => $fpaform,
                'applicant_photograph' => $applicant_photograph
                ]
        );

       $alloteefilesid =  $alloteefiles['id'];
        foreach ($input['transactionform2'] as $key => $value) {
            $imagestringfront = str_replace(' ', '', $value['nextofkinfilefront']->getClientOriginalName());
            $imagestringback = str_replace(' ', '', $value['nextofkinfileback']->getClientOriginalName());
            $fileNamefront = time().$imagestringfront;
            $fileNameback = time().$imagestringback;
            $destinationPath = public_path('kinsfiles');
            if($value['nextofkinfilefront']->move($destinationPath, $fileNamefront)){
                $temp1 = array(
                    'alloteefiles_id' => $alloteefilesid,
                    'application_id' => $input['application_id'],
                    'fileposition' => 'nextofkinfilefront',
                    'filetext' => $fileNamefront
                );

                kinsmultiplefile::create($temp1);

            }
            if($value['nextofkinfileback']->move($destinationPath, $fileNameback)){

                $temp2 = array(
                    'alloteefiles_id' => $alloteefilesid,
                    'application_id' => $input['application_id'],
                    'fileposition' => 'nextofkinfileback',
                    'filetext' => $fileNameback
                );
                kinsmultiplefile::create($temp2);
            }


        }
       $mergearray =  array_merge($temp1,$temp2);

        echo '<pre>';print_r($mergearray);die;

        if($alloteefiles){
            Session::flash('flash_message', 'Task successfully added!');
            return redirect('AllotteeParticular/Application_view');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, AllotteeDetailsOfKin::getValidationRules());
        $input = $request->all();
        $input['transactionform2'] = json_encode($input['transactionform2']);
        $input['user_id'] = Auth::id();
        $dataofalottee = AllotteeDetailsOfKin::create($input);
        Session::flash('flash_message', 'Task successfully added!');

         return redirect('AllotteeDetailsOfKin/create3/'.$dataofalottee['application_id']);
    }
    public function receivestore(Request $request)
    {
        $this->validate($request, AllotteeDetailsOfKin::getValidationRules());
        $input = $request->all();
        $dataofalottee = DB::table('allottee_details_service')->insert(
            [
                'application_id' => $input['application_id'],
                'user_id' => Auth::id(),
                'transaction' => json_encode($input['transaction'])
            ]
        );
     $id =    DB::getPdo()->lastInsertId();
     $details = DB::table('allottee_details_service')->where('id', $id)->first();

        Session::flash('flash_message', 'Task successfully added!');
         return redirect('AllotteeDetailsOfKin/create4/'.$details->application_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $model = AllotteeParticular::where('p_no', $id)->first();
      	return view('allotteeDetailsOfKin.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // $model = DB::table('allottee_particulars as alp')
        // ->select('*')
        // ->join('allottee_details_of_kins as adk', 'adk.application_id', '=', 'alp.id')
        // //->join('allottee_details_service as ads', 'ads.application_id', '=', 'alp.id')
        // ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
        // ->join('kinsmulltiplefiles as kinmul', 'kinmul.application_id', '=', 'alp.id')
        // ->where('alp.id',$id)
        // ->first();

        $model = AllotteeParticular::where('p_no', $id)->first();
        return view('allotteeDetailsOfKin.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function form2update(){
        DB::table('allottee_details_of_kins')
        ->where('application_id', $_POST['application_id'])
        ->update(
            array(
            'transactionform2' => json_encode($_POST['transactionform2']),
            'father_name' => $_POST['father_name'],
            'father_address' => $_POST['father_address'],
            'mother_address' => $_POST['mother_address'],
            'mother_name' => $_POST['mother_name'],
            'present_address' => $_POST['present_address'],
            'permanent_address' => $_POST['permanent_address'],
            )
        );

        Session::flash('flash_message', 'AllotteeDetailsOfKin successfully updated!');
        return redirect('AllotteeDetailsOfKin/create3edit/'.$_POST['application_id']);

    }
    public function form3update(){
        DB::table('allottee_details_service')
        ->where('application_id', $_POST['application_id'])
        ->update(
            array(
            'transaction' => json_encode($_POST['transaction']),
            )
        );

        Session::flash('flash_message', 'AllotteeDetailsOfKin successfully updated!');
        return redirect('AllotteeDetailsOfKin/create4edit/'.$_POST['application_id']);

    }
    public function form4update(Request $request){
        $input = $request->all();
        if ($request->hasFile('image')) {
                    $file = $request->file('image');
            if(isset ($file) && count($file) > 0){
                foreach ($file as $key => $image) {
                    //$fileName = $file->getClientOriginalName();
                    $imagestring = str_replace(' ', '', $image->getClientOriginalName());
                    $fileName = time().$imagestring;
                    $destinationPath = public_path('attachment');
                    if($image->move($destinationPath, $fileName)){
                        $temp[] = $fileName;
                    }
                }
                 $imgs = json_encode($temp);
            }else{
                $imgs = $input['old_image'];
            }
        }
        else{
            $imgs = $input['old_image'];
        }
        $allotteeimage = DB::table('allottee_files')->update(
            [
                'image' => $imgs,
                ]
        );
        Session::flash('flash_message', 'Task successfully added!');
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    {

        DB::table('allottee_particulars')->where('id', $id)->delete();
        DB::table('allottee_details_of_kins')->where('application_id', $id)->delete();
        DB::table('allottee_details_service')->where('application_id', $id)->delete();
        DB::table('allottee_files')->where('application_id', $id)->delete();
	    Session::flash('flash_message', 'Application Delete successfully deleted!');
	    return redirect('AllotteeParticular/Application_view');
    }
}

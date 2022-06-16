<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\AllotteeParticular;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use PDF;
use Response;
use App\Rank;
use App\Membershippayment;
use App\PaymentPolicy;
use App\Construction;
use App\Plot;
use App\HouseCost;
use App\Payment;
use App\AllotedHouse;
use App\UserWife;
use App\UserChild;
use App\UserMade;
use App\UserDriver;
use App\UserChef;
use App\UserGardener;
use App\UserParent;
use App\Alloteefiles;
use App\AllotteeDetailsOfKin;
use App\Kinsmultiplefile;
use App\Users;
use App\UserType;
use App\Userroles;
use App\PromotedMember;
use App\HouseCategory;
use App\AssignedPolicy;
use App\payableRegInsurance;
use App\PaymentPolicyData;

class AllotteeParticularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        if(Session::get('nextkin_old_data')){
            Session::put('nextkin_old_data', session()->pull('products', []));
        }
        if(Session::get('required_fields')){
            Session::put('required_fields', session()->pull('products'));
        }
        $formModel = new AllotteeParticular;
        $formModel->fill(Input::get());
        $perm = new Controller;
        $permissioninsert =  $perm->getpermission('Application_insert');
        $permissionview =  $perm->getpermission('Application_view');
        $permissionupdate =  $perm->getpermission('Application_update');
        $permissiondelete =  $perm->getpermission('Application_delete');
        if(isset($_GET['submit'])){
            $models = AllotteeParticular::Search();
            $ranks = Rank::where('status', 1)->pluck('name', 'id');
        }else{
            $ranks = Rank::where('status', 1)->pluck('name', 'id');
            $models = AllotteeParticular::orderby('id', 'DESC')->with('hasPayment')->where('seen', 1)->where('form_status', 0)->paginate(10);
            $records = AllotteeParticular::orderby('id', 'DESC')->with('hasPayment')->where('seen', 1)->where('form_status', 0)->get();
            return view('allotteeParticular.index', array('formModel' =>$formModel, 'records' => $records, 'models' => $models,'permissioninsert' => $permissioninsert , 'permissionview' => $permissionview ,'permissionupdate' => $permissionupdate , 'permissiondelete' => $permissiondelete, 'ranks' => $ranks ));
        }
        if (\Request::ajax()) {
            return view('allotteeParticular.ajax',  compact('models'));
        }
        return view('allotteeParticular.index', compact('models', 'formModel','ranks','permissioninsert','permissionview','permissionupdate','permissiondelete'));
    }

    public function standalone(){
        if(!empty(Auth::id())){
            return view('allotteeParticular.standalone');
        }
        else{
            return view('allotteeParticular.standalone');
        }

    }

    public function memberStatus(Request $request)
    {
        $record = AllotteeParticular::where('p_no', $request->member_id)->first();
        if($record){
            $record->status=$request->status;
            $record->remarks_status=$request->remarks;
        }
        $record->save();

        Session::flash('flash_message', 'Updated successfully!');
        return back();
    }

    public function standalonesubmit(Request $request){
        $input = $request->all();
        $allottecount = AllotteeParticular::getcount();
        $allottecounts=$allottecount+1;
        $seprateview = url('AllotteeParticular/approveapp/'.$allottecounts);
            $array1 = array(
                'p_no' => $input['p_no'],
                'cnic_no' => $input['cnic_no'],
                'rank_rate' => $input['rank_rate'],
                'name' => $input['name'],
                'cnic_no' => $input['cnic_no'],
                'd_o_b' => $input['d_o_b'],
                'father_name_particular' => $input['father_name_particular'],
                'd_o_e' => $input['d_o_e'],
                'branch' => $input['branch'],
                'd_o_c' => $input['d_o_c'],
                'd_o_p' => $input['d_o_p'],
                'd_o_sod' => $input['d_o_sod'],
                'd_o_sos' => $input['d_o_sos'],
                'd_o_s' => $input['d_o_s'],
                'total_service' => $input['total_service'],
                'tel_no' => $input['tel_no'],
                'mob_no' => $input['mob_no'],
                'email_address' => $input['email_address'],
                'seperate_view' => $seprateview,
                'created_at' => date('Y-m-d H:i:s')
            );
        $dataofalottee = AllotteeParticular::create($array1);
        $array2 = array(
            'application_id' => $dataofalottee['id'],
            'transactionform2' => json_encode($input['transactionform2']),
            'father_name' => $input['father_name'],
            'father_address' => $input['father_address'],
            'mother_name' => $input['mother_name'],
            'mother_address' => $input['mother_address'],
            'present_address' => $input['present_address'],
            'permanent_address' => $input['permanent_address'],
            'created_at' => date('Y-m-d H:i:s')
        );
        DB::table('allottee_details_of_kins')->insert($array2);
        $array3 = array(
            'application_id' => $dataofalottee['id'],
            'transaction' => json_encode($input['transaction']),
        );
        DB::table('allottee_details_service')->insert($array3);

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
                $imgdata = json_encode($temp);
            }else{
            $imgdata = null ;
            }
        }
        $allotteeimage = DB::table('allottee_files')->insert([
            'application_id' => $dataofalottee['id'],
            'image' => $imgdata
        ]);

        $array5 = array(
            'application_id' => $dataofalottee['id'],
            'sum_of' => $input['sum_of'],
            'draft_no' => $input['draft_no'],
            'date' => $input['date'],
            'pjo' => $input['pjo'],
            'rate' => $input['rate'],
            'countersigned_name' => $input['countersigned_name'],
            'countersigned_no' => $input['countersigned_no'],
            'dated' => $input['dated']
        );

        DB::table('other')->insert($array5);
        $model = DB::table('allottee_particulars as alp')
        ->select('*')
        ->join('allottee_details_of_kins as adk', 'adk.application_id', '=', 'alp.id')
        //->join('allottee_details_service as ads', 'ads.application_id', '=', 'alp.id')
        ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
        ->join('other as ot', 'ot.application_id', '=', 'alp.id')
        ->where('alp.id',$dataofalottee['id'])
        ->first();
        //echo '<pre>';print_r($model);die;
        $pdf = PDF::loadView('allotteeParticular.standalonepdf', compact('model'));
        return $pdf->download('Pnwhs.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

        public function create(){
            // if(Session::get('nextkin_old_data')){
            //     Session::put('nextkin_old_data', session()->pull('products', []));
            // }
            $ranks = Rank::where('status', 1)->pluck('name', 'id');
            return view('allotteeParticular.create', compact('ranks'));
        }

        public function getLastRegFileNo($id)
        {
            $policy = PaymentPolicyData::where('rank_id', $id)->where('expire_date', null)->first();
            if(!empty($policy)){
                $rank = Rank::where('id', $id)->first(['category', 'name']);
                $ranks = Rank::where('category', $rank->category)->get(['id']);
                
                $last_reg_file_number = AllotteeParticular::orderby('id', 'DESC')->where('reg_file_no', '!=', NULL)->whereIn('rank_rate', $ranks)->first(['reg_file_no']);

                $category = HouseCategory::where('id', $rank->category)->where('status', 1)->first();
                $reg_file_no = '';

                if($last_reg_file_number){
                    $reg_file_no = $last_reg_file_number->reg_file_no;
                }else{
                    $reg_file_no = 0;
                }
                return response()->json(['reg_file_no' => $reg_file_no]);
            }else{
                return response()->json(['reg_file_no' => 'policy']);
            }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function updateFormStatus(Request $request)
    {
        if($request->submit=='submit'){
            $record = AllotteeParticular::where('p_no', $request->p_no)->first();
            $record->form_status=0;
            $record->update();

            Session::flash('flash_message', 'Form Submitted Successfully!');
            if(Auth::user()->hasRole->role=='Admin'){
                return redirect('AllotteeParticular');
            }else{
                return redirect('/');
            }
        }else{
            $record = AllotteeParticular::where('p_no', $request->p_no)->delete();
            if($record){
                AllotteeDetailsOfKin::where('p_no', $request->p_no)->delete();
                Alloteefiles::where('p_no', $request->p_no)->delete();
                Kinsmultiplefile::where('p_no', $request->p_no)->delete();

                Session::flash('record_exists', 'Form Submission Cancelled!');
                if(Auth::user()->hasRole->role=='Admin'){
                    return redirect('AllotteeParticular');
                }else{
                    return redirect('/');
                }
            }
        }
    }

    public function store(Request $request)
    {
        if(!empty($request->nextkins)){
            if(Session::get('nextkin_old_data')){
                Session::put('nextkin_old_data', session()->pull('products', []));
            }
            Session::push('nextkin_old_data', $request->nextkins);
        }

        $rules = [];
        $rules1 = ([
            'p_no' => 'required',
            'rank_rate' => 'required',
            'unit' => 'required',
            'branch' => 'required',
            'name' => 'required',
            'mob_no' => 'required',
            'cnic_no' => 'required',
            'd_o_b' => 'required',
            'd_o_e' => 'required',
            'd_o_c' => 'required',
            'd_o_p' => 'required',
            'd_o_sod' => 'required',
            'total_service' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'nextkins.*.name' => 'required',
            'nextkins.*.relation' => 'required',
            'nextkins.*.cnic' => 'required',
            'nextkins.*.mobilenumber' => 'required',
            'nextkins.*.share' => 'required',
            'nextkins.*.kinaddress' => 'required',
        ]);

        if(Auth::user()->hasRole->role=='Admin'){
            $rules2 = ([
                'reg_file_no' => 'required|unique:allottee_particulars,reg_file_no|unique:promoted_members,file_registration_no',
                'membership_date' => 'required',
            ]);

            $rules = array_merge($rules1, $rules2);
        }else{
            $rules = $rules1;
        }
        
        if(!empty($request->nextkins)){
            foreach($request->nextkins as $key=>$nextkin){
                if($nextkin['name']=='' || $nextkin['relation']=='' || $nextkin['cnic']=='' || $nextkin['mobilenumber'] == '' || $nextkin['share'] == '' || $nextkin['kinaddress'] == ''){
                    Session::flash('required_fields', "Next of Kin's * fields are required.");
                    $this->validate($request, $rules);                
                }
            }
        }
        
        $this->validate($request, $rules);

        if(Session::get('nextkin_old_data')){
            Session::put('nextkin_old_data', session()->pull('products', []));
        }
        if(Session::get('required_fields')){
            Session::put('required_fields', session()->pull('products'));
        }

        $ifnotexist = AllotteeParticular::where('p_no', $request->p_no)->first();
        if(empty($ifnotexist)){
            $pay_policy = PaymentPolicyData::orderby('id', 'DESC')->where('rank_id', $request->rank_rate)->first();
            $inserted = AllotteeParticular::create([
                'created_by' => Auth::user()->id,
                'reg_file_no' => $request->reg_file_no,
                'membership_date' => $request->membership_date,
                'p_no' => $request->p_no,
                'original_p_no' => $request->p_no,
                'honu_p_no' => $request->honu_p_no,
                'rank_rate' => $request->rank_rate,
                'soldier' => $request->soldier,
                'name' => $request->name,
                'cnic_no' => $request->cnic_no,
                'd_o_b' => $request->d_o_b,
                'mob_no' => $request->mob_no,
                'tel_no' => $request->tel_no,
                'email_address' => $request->email_address,
                'd_o_e' => $request->d_o_e,
                'd_o_c' => $request->d_o_c,
                'd_o_p' => $request->d_o_p,
                'd_o_sod' => $request->d_o_sod,
                'd_o_sos' => $request->d_o_sos,
                'd_o_s' => $request->d_o_s,
                'total_service' => $request->total_service,
                'salary' => $request->salary,
                'any_other_benifit' => $request->any_other_benifit,
                'unit' => $request->unit,
                'branch' => $request->branch,
                'permanent_address' => $request->permanent_address,
                'present_address' => $request->present_address,
                'date' => date('d-m-Y'),
                'form_status' => $request->reg_file_no!=''?1:0,
                'status' => 0,
            ]);

            $member_emp_record = PromotedMember::create([
                'created_by' => Auth::user()->id,
                'member_id' => $inserted->id,
                'promoted_rank_id' => $request->rank_rate,
                'file_registration_no' => $request->reg_file_no,
                // 'old_p_no' => $request->p_no,
                'new_p_no' => $request->p_no,
                'd_o_p' => date('Y-m-d', strtotime($request->d_o_p)),
                'd_o_sod' => $request->d_o_sod,
                'd_o_sos' => $request->d_o_sos,
                'd_o_s' => $request->d_o_s,
                'soldier' => $request->soldier,
                'rank_rate' => $request->branch,
                'gross_salary' => $request->salary,
                'total_service' =>$request->total_service,
            ]);

            if($member_emp_record){
                $pay_policy = PaymentPolicyData::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('rank_id', $member_emp_record->promoted_rank_id)->first();
                payableRegInsurance::create([
                    'promoted_id' => $member_emp_record->id,
                    'member_id' => $member_emp_record->member_id,
                    'policy_id' => $pay_policy->hasPaymentPolicy->id,
                    'total_amount' => $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment,
                    'payable_amount' => $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment,
                ]);
            }

            if(!empty($request->nextkins)){
                foreach($request->nextkins as $nextkin){
                    AllotteeDetailsOfKin::create([
                        'p_no' => $request->p_no,
                        'name' => $nextkin['name'],
                        'relation' => $nextkin['relation'],
                        'define_other' => $nextkin['define_other'],
                        'cnic_no' => $nextkin['cnic'],
                        'mobile_no' => $nextkin['mobilenumber'],
                        'country_code' => $nextkin['country_code'],
                        'share' => $nextkin['share'],
                        'address' => $nextkin['kinaddress'],
                    ]);
                }
            }
            //Add Cnic Front
            $cnicfront = '';
            if (!empty($request->cnicfront)) {
                $file = $request->file('cnicfront');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $cnicfront = $file_name;
            }

            // Add Cnicn Back
            $cnicback = '';
            if (!empty($request->cnicback)) {
                $file = $request->file('cnicback');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $cnicback = $file_name;
            }

            // Add children B form
            $childrenbform = '';
            if (!empty($request->childrenbform)) {
                $file = $request->file('childrenbform');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $childrenbform = $file_name;
            }

            // Add promotion_letter
            $promotion_letter = '';
            if (!empty($request->promotion_letter)) {
                $file = $request->file('promotion_letter');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $promotion_letter = $file_name;
            }

            // Add fpaform
            $fpaform = '';
            if (!empty($request->fpaform)) {
                $file = $request->file('fpaform');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $fpaform = $file_name;
            }

            // Add applicant photograph
            $applicant_photograph = '';
            if (!empty($request->applicant_photograph)) {
                $file = $request->file('applicant_photograph');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $applicant_photograph = $file_name;
            }

            // Add frp_fc 10 form
            $frp_fc = '';
            if (!empty($request->frp_fc)) {
                $file = $request->file('frp_fc');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $frp_fc = $file_name;
            }

            // Add draft_cheque
            $draft_cheque = '';
            if (!empty($request->draft_cheque)) {
                $file = $request->file('draft_cheque');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $draft_cheque = $file_name;
            }
            
            // Add any_other_docs
            $any_other_docs = '';
            if (!empty($request->any_other_docs)) {
                $file = $request->file('any_other_docs');
                $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $any_other_docs = $file_name;
            }

            $alloteefiles =  Alloteefiles::create( [
                'p_no' => $request->p_no,
                'cnicfront' => $cnicfront,
                'cnicback' => $cnicback,
                'childrenbform' => $childrenbform,
                'promotion_letter' => $promotion_letter,
                'fpaform' => $fpaform,
                'applicant_photograph' => $applicant_photograph,
                'frp_fc' => $frp_fc,
                'draft_cheque' => $draft_cheque,
                'any_other_docs' => $any_other_docs
            ]);

            $alloteefilesid = $alloteefiles->id;

            if(!empty($request->transactionform2)){
                foreach ($request->transactionform2 as $key => $value) {
                    if(isset($value['nextofkinfilefront']) && $value['nextofkinfilefront'] != null ){
                        $imagestringfront = str_replace(' ', '', $value['nextofkinfilefront']->getClientOriginalName());
                        $fileNamefront = time().$imagestringfront;
                        $destinationPath = public_path('kinsfiles');

                        if($value['nextofkinfilefront']->move($destinationPath, $fileNamefront)){
                            Kinsmultiplefile::create([
                                'p_no' => $request->p_no,
                                'fileposition' => 'nextofkinfilefront',
                                'filetext' => $fileNamefront
                            ]);
                        }
                    }
    
                    if(isset($value['nextofkinfileback']) && $value['nextofkinfilefront'] != null ){
                        $imagestringback = str_replace(' ', '', $value['nextofkinfileback']->getClientOriginalName());
                        $fileNameback = time().$imagestringback;
                        $destinationPath = public_path('kinsfiles');

                        if($value['nextofkinfileback']->move($destinationPath, $fileNameback)){
                            Kinsmultiplefile::create([
                                'p_no' => $request->p_no,
                                'fileposition' => 'nextofkinfileback',
                                'filetext' => $fileNameback
                            ]);
                        }
                    }
                }
            }

            $user = Users::where('p_no', $request->p_no)->first();
            if(empty($user)){
                $user_type = UserType::where('name', 'user')->first();
                $user_role = Userroles::where('role', 'user')->first();
                Users::create([
                    'p_no' => $request->p_no,
                    'name' => $request->name,
                    'user_type' => $user_type->id, //User Type ID
                    'role' => $user_role->id, //User Role ID
                    'created_by' => Auth::id(),
                    'email' => $request->p_no,
                    'password' => bcrypt($request->p_no),
                    'is_active' => 1
                ]);
            } 

            // Session::flash('flash_message', 'Task successfully added!');
            // $rank = Rank::where('id', $request->rank_rate)->first();
            // $payment_policy = PaymentPolicy::orderby('id', 'DESC')->where('cat_id', $rank->category)->first();
            // AssignedPolicy::create([
            //     'policy_id' => $payment_policy->id,
            //     'p_no' => $request->p_no,
            // ]);

            $model = AllotteeParticular::where('p_no', $inserted->p_no)->first();
      	    return view('allotteeParticular.show', array('model' => $model));
        }else{
            Session::flash('record_exists', 'Sorry! Already exist this user.!');
            return back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    //Get Notification

    public function show($id)
    {
        $model = AllotteeParticular::where('id', $id)->first();
      	return view('allotteeParticular.show', array('model' => $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $model = AllotteeParticular::where('p_no', $id)->first();
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('allotteeParticular.edit', compact('ranks'))->withModel($model);
    }
    //Update Function alooteparticular
    public function update($id, Request $request)
    {
        if(!empty($request->nextkins)){
            if(Session::get('nextkin_old_data')){
                Session::put('nextkin_old_data', session()->pull('products', []));
            }
            Session::push('nextkin_old_data', $request->nextkins);
        }

        $rules = [];
        $rules1 = ([
            'p_no' => 'required',
            'rank_rate' => 'required',
            'unit' => 'required',
            'branch' => 'required',
            'name' => 'required',
            'mob_no' => 'required',
            'cnic_no' => 'required',
            'd_o_b' => 'required',
            'd_o_e' => 'required',
            'd_o_c' => 'required',
            'd_o_p' => 'required',
            'd_o_sod' => 'required',
            'total_service' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'nextkins.*.name' => 'required',
            'nextkins.*.relation' => 'required',
            'nextkins.*.cnic' => 'required',
            'nextkins.*.mobilenumber' => 'required',
            'nextkins.*.share' => 'required',
            'nextkins.*.kinaddress' => 'required',
        ]);

        if(Auth::user()->hasRole->role=='Admin'){
            $rules2 = ([
                // 'reg_file_no' => 'required|unique:allottee_particulars,reg_file_no|unique:promoted_members,file_registration_no',
                'membership_date' => 'required',
            ]);

            $rules = array_merge($rules1, $rules2);
        }else{
            $rules = $rules1;
        }
        
        if(!empty($request->nextkins)){
            foreach($request->nextkins as $key=>$nextkin){
                if($nextkin['name']=='' || $nextkin['relation']=='' || $nextkin['cnic']=='' || $nextkin['mobilenumber'] == '' || $nextkin['share'] == '' || $nextkin['kinaddress'] == ''){
                    Session::flash('required_fields', "Next of Kin's * fields are required.");
                    $this->validate($request, $rules);                
                }
            }
        }

        $this->validate($request, $rules);

        if(Session::get('nextkin_old_data')){
            Session::put('nextkin_old_data', session()->pull('products', []));
        }
        if(Session::get('required_fields')){
            Session::put('required_fields', session()->pull('products'));
        }

        $promoted_rec = PromotedMember::where('new_p_no', $request->p_no)->first();
        if(!empty($promoted_rec)){
            $promoted_rec->created_by = Auth::user()->id;
            $promoted_rec->promoted_rank_id = $request->rank_rate;
            $promoted_rec->file_registration_no = $request->reg_file_no;
            $promoted_rec->new_p_no = $request->p_no;
            $promoted_rec->d_o_p = $request->d_o_p;
            $promoted_rec->d_o_sod = $request->d_o_sod;
            $promoted_rec->soldier = $request->soldier;

            if($request->soldier=='civilian'){
                $promoted_rec->d_o_s = $request->d_o_s;
                $promoted_rec->d_o_sos = null;
            }else{
                $promoted_rec->d_o_sos = $request->d_o_sos;
                $promoted_rec->d_o_s = null;
            }
            
            $promoted_rec->gross_salary = $request->salary;
            $promoted_rec->total_service = $request->total_service;
            $promoted_rec->update();
            
            $record = AllotteeParticular::where('id', $promoted_rec->member_id)->first();

            // $record->reg_file_no = $request->reg_file_no;
            // $record->rank_rate = $request->rank_rate;
            // $record->soldier = $request->soldier;
            // $record->created_by = Auth::user()->id;

            $record->name = $request->name;
            $record->membership_date = $request->membership_date;
            $record->cnic_no = $request->cnic_no;
            $record->d_o_b = $request->d_o_b;
            $record->email_address = $request->email_address;
            $record->mob_no = $request->mob_no;
            $record->tel_no = $request->tel_no;
            $record->present_address = $request->present_address;
            $record->permanent_address = $request->permanent_address;
            $record->d_o_e = $request->d_o_e;
            $record->d_o_c = $request->d_o_c;

            // $record->d_o_p = $request->d_o_p;
            // $record->d_o_sod = $request->d_o_sod;
            // $record->d_o_sos = $request->d_o_sos;
            // $record->d_o_s = $request->d_o_s;
            // $record->total_service = $request->total_service;

            // $record->salary = $request->salary;
            $record->any_other_benifit = $request->any_other_benifit;
            $record->unit = $request->unit;
            $record->branch = $request->branch;
            $record->date = date('d-m-Y');
            $record->status = 1;
            $record->save();
        }else{
            $record = AllotteeParticular::where('id', $promoted_rec->member_id)->first();
            $record->reg_file_no = $request->reg_file_no;
            $record->membership_date = $request->membership_date;
            $record->rank_rate = $request->rank_rate;
            $record->soldier = $request->soldier;
            $record->created_by = Auth::user()->id;
            $record->name = $request->name;
            $record->cnic_no = $request->cnic_no;
            $record->d_o_b = $request->d_o_b;
            $record->email_address = $request->email_address;
            $record->mob_no = $request->mob_no;
            $record->tel_no = $request->tel_no;
            $record->present_address = $request->present_address;
            $record->permanent_address = $request->permanent_address;
            $record->d_o_e = $request->d_o_e;
            $record->d_o_c = $request->d_o_c;
            $record->d_o_p = $request->d_o_p;
            $record->d_o_sod = $request->d_o_sod;

            if($request->soldier=='civilian'){
                $record->d_o_s = $request->d_o_s;
                $record->d_o_sos = null;
            }else{
                $record->d_o_sos = $request->d_o_sos;
                $record->d_o_s = null;
            }
            
            $record->total_service = $request->total_service;
            $record->salary = $request->salary;
            $record->any_other_benifit = $request->any_other_benifit;
            $record->unit = $request->unit;
            $record->branch = $request->branch;
            $record->date = date('d-m-Y');
            $record->status = 1;
            $record->save();

            $emp_record = PromotedMember::orderby('id', 'DESC')->where('member_id', $id)->first();
            $emp_record->promoted_rank_id = $record->rank_rate;
            $emp_record->file_registration_no = $record->reg_file_no;
            $emp_record->d_o_p = date('Y-m-d', strtotime($record->d_o_p));
            $emp_record->d_o_sod = $record->d_o_sod;

            if($record->soldier=='civilian'){
                $emp_record->d_o_s = $record->d_o_s;
                $emp_record->d_o_sos = null;
            }else{
                $emp_record->d_o_sos = $record->d_o_sos;
                $emp_record->d_o_s = null;
            }

            $emp_record->soldier = $record->soldier;
            $emp_record->rank_rate = $record->branch;
            $emp_record->gross_salary = $record->salary;
            $emp_record->total_service = $record->total_service;
            $emp_record->update();

            if($emp_record){
                payableRegInsurance::where('promoted_id', $emp_record->id)->delete();
                $pay_policy = PaymentPolicyData::with('hasPaymentPolicy')->orderby('id', 'DESC')->where('rank_id', $emp_record->promoted_rank_id)->first();
                payableRegInsurance::create([
                    'promoted_id' => $pay_policy->id,
                    'member_id' => $pay_policy->member_id,
                    'policy_id' => $pay_policy->hasPaymentPolicy->id,
                    'total_amount' => $pay_policy->hasPaymentPolicy->registration_payment+$pay_policy->hasPaymentPolicy->insurance_payment,
                    'payable_amount' => $pay_policy->hasPaymentPolicy->insurance_payment+$pay_policy->hasPaymentPolicy->insurance_payment,
                ]);
            }
        }

        if(!empty($request->nextkins)){
            AllotteeDetailsOfKin::where('p_no', $request->p_no)->delete();
            foreach($request->nextkins as $nextkin){
                AllotteeDetailsOfKin::create([
                    'p_no' => $request->p_no,
                    'name' => $nextkin['name'],
                    'relation' => $nextkin['relation'],
                    'define_other' => $nextkin['define_other']??'--',
                    'cnic_no' => $nextkin['cnic'],
                    'mobile_no' => $nextkin['mobilenumber'],
                    'country_code' => $nextkin['country_code'],
                    'share' => $nextkin['share']??0,
                    'address' => $nextkin['kinaddress'],
                ]);
            }
        }

        //Add Cnic Front
        $cnicfront = '';
        if (!empty($request->cnicfront)) {
            $file = $request->file('cnicfront');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $cnicfront = $file_name;
        }

        // Add Cnicn Back
        $cnicback = '';
        if (!empty($request->cnicback)) {
            $file = $request->file('cnicback');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $cnicback = $file_name;
        }

        // Add children B form
        $childrenbform = '';
        if (!empty($request->childrenbform)) {
            $file = $request->file('childrenbform');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $childrenbform = $file_name;
        }

        // Add Promotion letter
        $promotion_letter = '';
        if (!empty($request->promotion_letter)) {
            $file = $request->file('promotion_letter');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $promotion_letter = $file_name;
        }

        // Add fpaform
        $fpaform = '';
        if (!empty($request->fpaform)) {
            $file = $request->file('fpaform');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $fpaform = $file_name;
        }

        // Add applicant photograph
        $applicant_photograph = '';
        if (!empty($request->applicant_photograph)) {
            $file = $request->file('applicant_photograph');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $applicant_photograph = $file_name;
        }

        // Add frp_fc 10 form
        $frp_fc = '';
        if (!empty($request->frp_fc)) {
            $file = $request->file('frp_fc');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $frp_fc = $file_name;
        }

        // Add draft_cheque
        $draft_cheque = '';
        if (!empty($request->draft_cheque)) {
            $file = $request->file('draft_cheque');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $draft_cheque = $file_name;
        }
        
        // Add any_other_docs
        $any_other_docs = '';
        if (!empty($request->any_other_docs)) {
            $file = $request->file('any_other_docs');
            $file->move(public_path('alloteefiles'), $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $any_other_docs = $file_name;
        }

        if(!empty($request->cnicfront)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->cnicfront = $cnicfront;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'cnicfront' => $cnicfront,
                ]);
            }
        }

        if(!empty($request->cnicback)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->cnicback = $cnicback;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'cnicback' => $cnicback,
                ]);
            }
        }

        if(!empty($request->childrenbform)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->childrenbform = $childrenbform;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'childrenbform' => $childrenbform,
                ]);
            }
        }

        if(!empty($request->promotion_letter)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->promotion_letter = $promotion_letter;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'promotion_letter' => $promotion_letter,
                ]);
            }
        }

        if(!empty($request->fpaform)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->fpaform = $fpaform;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'fpaform' => $fpaform,
                ]);
            }

        }

        if(!empty($request->applicant_photograph)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->applicant_photograph = $applicant_photograph;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'applicant_photograph' => $applicant_photograph,
                ]);
            }
        }

        if(!empty($request->frp_fc)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->frp_fc = $frp_fc;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'frp_fc' => $frp_fc,
                ]);
            }
        }

        if(!empty($request->draft_cheque)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->draft_cheque = $draft_cheque;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'draft_cheque' => $draft_cheque,
                ]);
            }
        }
        
        if(!empty($request->any_other_docs)){
            $ifexist = Alloteefiles::where('p_no', $request->p_no)->first();
            if($ifexist){
                $ifexist->any_other_docs = $any_other_docs;
                $ifexist->save();
            }else{
                $alloteefiles =  Alloteefiles::create( [
                    'p_no' => $request->p_no,
                    'any_other_docs' => $any_other_docs,
                ]);
            }
        }

        if(!empty($request->transactionform2)){
            foreach ($request->transactionform2 as $key => $value) {
                if(isset($value['nextofkinfilefront']) && $value['nextofkinfilefront'] != null ){
                    $imagestringfront = str_replace(' ', '', $value['nextofkinfilefront']->getClientOriginalName());
                    $fileNamefront = time().$imagestringfront;
                    $destinationPath = public_path('kinsfiles');

                    if($value['nextofkinfilefront']->move($destinationPath, $fileNamefront)){
                        $temp1 = array(
                            'p_no' => $request->p_no,
                            'fileposition' => 'nextofkinfilefront',
                            'filetext' => $fileNamefront
                        );

                        Kinsmultiplefile::create($temp1);
                    }
                }

                if(isset($value['nextofkinfileback']) && $value['nextofkinfileback'] != null){
                    $imagestringback = str_replace(' ', '', $value['nextofkinfileback']->getClientOriginalName());
                    $fileNameback = time().$imagestringback;
                    $destinationPath = public_path('kinsfiles');

                    if($value['nextofkinfileback']->move($destinationPath, $fileNameback)){
                        $temp2 = array(
                            'p_no' => $request->p_no,
                            'fileposition' => 'nextofkinfileback',
                            'filetext' => $fileNameback
                        );

                        Kinsmultiplefile::create($temp2);
                    }
                }
            }
        }

        // if($request->p_no){
        //     $rank = Rank::where('id', $request->rank_rate)->first();
        //     $payment_policy = PaymentPolicy::orderby('id', 'DESC')->where('cat_id', $rank->category)->first();

        //     $exist = AssignedPolicy::where('p_no', $request->p_no)->where('policy_id', $payment_policy->id)->first();
        //     if(empty($exist)){
        //         AssignedPolicy::create([
        //             'policy_id' => $payment_policy->id,
        //             'p_no' => $request->p_no,
        //         ]);
        //     }
        // }

        Session::flash('flash_message', 'Member Information successfully updatedd!');
        return back();
    }

    public function deleteImage(Request $request)
    {
        $found = Alloteefiles::where('p_no', $request->p_no)->first();
        if($found->cnicfront==$request->img_name){
            $found->cnicfront = null;
        }else if($found->cnicback==$request->img_name){
            $found->cnicback = null;
        }else if($found->childrenbform==$request->img_name){
            $found->childrenbform = null;
        }else if($found->fpaform==$request->img_name){
            $found->fpaform = null;
        }else if($found->applicant_photograph==$request->img_name){
            $found->applicant_photograph = null;
        }else if($found->frp_fc==$request->img_name){
            $found->frp_fc = null;
        }else if($found->draft_cheque==$request->img_name){
            $found->draft_cheque = null;
        }else if($found->promotion_letter==$request->img_name){
            $found->promotion_letter = null;
        }else if($found->any_other_docs==$request->img_name){
            $found->any_other_docs = null;
        }
        $found->update();

        return 1;
    }

    public function deleteNextKinImg(Request $request)
    {
        $ifdeleted = Kinsmultiplefile::where('p_no', $request->p_no)->where('filetext', $request->img_name)->delete();
        if($ifdeleted){
            return 1;
        }
    }

    public function uniqueuser(){
        $pno =  $_POST['selected_value'];

        $datapno =   DB::table('allottee_particulars')->where('p_no',$pno)->first();
        if(!empty($datapno)){
            return  '1';
        }else{
            return '0';
        }
     }

    public function applicationdata(){
        if(isset($_GET['submit'])){
            $perm = new Controller;
            $permissioninsert =  $perm->getpermission('Application_insert');
            $permissionview =  $perm->getpermission('Application_view');
            $permissionupdate =  $perm->getpermission('Application_update');
            $permissiondelete =  $perm->getpermission('Application_delete');
              $models = DB::table('allottee_particulars as alp')
              ->select('*')
              ->join('allottee_details_of_kins as adk', 'adk.p_no', '=', 'alp.id')
              ->join('allottee_files as alf', 'alf.application_id', '=', 'alp.id')
              ->where('alp.name',$_GET['name'])
              ->paginate(12);
              return view('allotteeDetailsOfKin.index',
               array('models' => $models,'permissioninsert' => $permissioninsert ,
              'permissionview' => $permissionview ,'permissionupdate' => $permissionupdate , 'permissiondelete' => $permissiondelete ));
        }else{
            $perm = new Controller;
            $permissioninsert =  $perm->getpermission('Application_insert');
            $permissionview =  $perm->getpermission('Application_view');
            $permissionupdate =  $perm->getpermission('Application_update');
            $permissiondelete =  $perm->getpermission('Application_delete');

            $ranks = Rank::where('status', 1)->pluck('name', 'id');
            $models = AllotteeParticular::orderby('id', 'DESC')->where('seen', 1)->paginate(10);

            return view('allotteeDetailsOfKin.index', array('models' => $models,'permissioninsert' => $permissioninsert , 'permissionview' => $permissionview ,'permissionupdate' => $permissionupdate , 'permissiondelete' => $permissiondelete, 'ranks' => $ranks ));
        }
    }
    public function assigndata(){
        $amount_converter = new Controller;
        $available_house = HouseCost::orderby('id', 'DESC')->first();
        $members = AllotteeParticular::with('hasRank', 'hasUser', 'hasMemberStatus')->orderby('total_service', 'DESC')->where('plotassigned', 0)->where('get_profit_id', null)->get();
        $ranks = Rank::where('status', 1)->get();
        return view('allotteeDetailsOfKin.assignplot', compact('members', 'available_house', 'amount_converter', 'ranks'));
    }

      //Assign Plot
    public function assignplotview($id){
        $memberid = $id;
        $allottee = DB::table('allottee_particulars')->where('id',$id)->first();
        $membershippayment =  DB::table('membershippayment')->where('id',$allottee->membersip_id)->value('mpayment');
        $memberpayment = DB::table('payment')
            ->leftJoin('contacts', 'payment.p_no', '=', 'contacts.p_no')
            ->select(DB::raw("SUM(payment.amounts  + IFNULL(contacts.amount,0)) as amount"))
            ->where('payment.p_no',$allottee->p_no)
            ->first();

            $memberpayment = $memberpayment->amount;
        return view('allotteeDetailsOfKin.assignplotview',compact('memberid','memberpayment','membershippayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function viewfiles($id){
        $imagedata =  DB::table('allottee_particulars')->where('id',$id)->first();
        $jsondata =  json_decode($imagedata->approvedocument);
        return view('allotteeParticular.imageview', compact('jsondata'));
    }

    public function updatefile(Request $request){
        $input = $request->all();
        $files = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    if(isset ($file) && count($file) > 0){
        foreach ($file as $key => $image) {
            $imagestring = str_replace(' ', '', $image->getClientOriginalName());
            $fileName = time().$imagestring;
            $destinationPath = public_path('attachment');
            if($image->move($destinationPath, $fileName)){
                $temp[] = $fileName;
            }
        }
        $files = json_encode($temp);
    }else{
        $files = null ;
    }
    DB::table('allottee_particulars')
    ->where('id', $input['rowid'])
    ->update(['approvedocument' => $files]);
}
Session::flash('flash_message', 'File Uploaded Successfully!');
            return redirect()->back();

    }

    //Assigned Plot Submit
    public function assignedplotsubmit(Request $request){
        $input = $request->all();
        unset($input['_token']);
      $contractor_id =   DB::table('constructor')->where('name',$input['contractor_id'])->first();
      $member_id =   DB::table('allottee_particulars')->where('plotassigned',0)->where('name',$input['member_id'])->first();
      $membershippayment = DB::table('membershippayment')->where('mpayment',$input['membership_id'])->orderBy('id','desc')->value('id');
      $input['p_no'] = $member_id->p_no;
      $input['membership_id'] = $membershippayment;
      $input['contractor_id'] = $contractor_id->id;
      $input['member_id'] = $member_id->id;
      $input['created_by'] = Auth::id();
      $input['created'] = date('Y-m-d H:i:s');
      $datainsert =  DB::table('assignplot')->insert($input);
       if($datainsert){
        DB::table('allottee_particulars')
        ->where('id', $input['member_id'])
        ->update(['plotassigned' => 1]);
            DB::table('plots')
            ->where('id', $input['plot_id'])
            ->update(['assign_plot' => 1]);
            Session::flash('flash_message', 'Plot Assigned Successfully!');
            return redirect()->back();
       }
    }

    public function getconstruction(){
        $plotid  =  $_POST['selected_value'];
    $dataplot =  DB::table('plots')->where('id',$plotid)->first();
       if(!empty($plotid)){
      $data =  DB::table('construction')->where('plot_id',$plotid)->first();
      if(!empty($data)){
        $datacontractor =  DB::table('constructor')->where('id',$data->constructor_id)->first();
      $contractordata = array(
          'contractorname' => $datacontractor->name,
          'construction_amount' => $data->initial_price,
          'plotamount' => $dataplot->amount
        );
    return $contractordata;
      }
      else{
        return 0;
      }
}
    }


//Comment Old Function

    // public function update($id, Request $request)
    // {
    //     //
    //    $model = AllotteeParticular::findOrFail($id);

	//     $this->validate($request, AllotteeParticular::getValidationRules());

	//     $model->fill( $request->all() )->save();

	//     Session::flash('flash_message', 'AllotteeParticular successfully updated!');

    //     return redirect()->back();

    // }

    public function approveapp($id){
        DB::table('allottee_particulars')
        ->where('id', $id)
        ->update(['seen' => 1]);
        Session::flash('flash_message', 'Application Status successfully updated!');
	    return redirect('AllotteeParticular');
    }

    public function approve($id)
    {
        DB::table('users')
        ->where('id', $id)
        ->update(['is_active' => 1]);
        Session::flash('flash_message', 'User activated successfully!');
	    return redirect('Users');
    }

            public function approveappbyuser($id,$seen){
        if($seen == 0){
            DB::table('allottee_particulars')
            ->where('id', $id)
            ->update(['seen' => 1]);
        }
        else{
            DB::table('allottee_particulars')
            ->where('id', $id)
            ->update(['seen' => 0]);
        }
        Session::flash('flash_message', 'Application Status successfully updated!');
        return redirect('AllotteeParticular/Application_view');
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
        $rec = AllotteeParticular::where('id', $id)->frist();
        $model = AllotteeParticular::findOrFail($id);
        $model->delete();

        if($model){
            AllotteeDetailsOfKin::where('p_no', $rec->p_no)->delete();
            Alloteefiles::where('p_no', $rec->p_no)->delete();
            Kinsmultiplefile::where('p_no', $rec->p_no)->delete();
        }

	    Session::flash('flash_message', 'AllotteeParticular successfully deleted!');

	    return redirect()->route('allotteeParticular.index');
    }

    //Allotee Compelted Details
    public function allotee_completed_details($id){
        $alloteeselecteddata = AllotteeParticular::where('p_no', $id)->first();
        return view('allotteeDetailsOfKin.allotee_completed_details',compact('alloteeselecteddata'));
    }

    //get all active members
    public function activemembers(){
        $models = AllotedHouse::paginate(10);
        $ranks = Rank::where('status', 1)->pluck('name', 'id');
        return view('allotteeDetailsOfKin.house_alloted_details', compact('models', 'ranks'));
    }

    public function memberMoreDetails(Request $request)
    {
        if(isset($request->form_status)){
            if(!empty($request->wife)){
                UserWife::where('p_no', $request->p_no)->delete();
                foreach($request->wife as $wife){
                    UserWife::create([
                        'p_no' => $request['p_no'],
                        'name' => $wife['wife_name'],
                        'cnic_no' => $wife['wife_cnic'],
                        'mobile_no' => $wife['wife_mobile'],
                        'security_clearance' => isset($wife['wife_security_clearance']),
                        'blacklist' => isset($wife['wife_blacklist']),
                    ]);
                }
            }
            if(!empty($request->children)){
                UserChild::where('p_no', $request->p_no)->delete();
                foreach($request->children as $child){
                    UserChild::create([
                        'p_no' => $request['p_no'],
                        'name' => $child['child_name'],
                        'age' => $child['child_age'],
                        'gender' => $child['child_gender'],
                        'security_clearance' => isset($child['child_security_clearance']),
                        'blacklist' => isset($child['child_blacklist']),
                    ]);
                }
            }
            if(!empty($request->made)){
                UserMade::where('p_no', $request->p_no)->delete();
                foreach($request->made as $made){
                    UserMade::create([
                        'p_no' => $request['p_no'],
                        'name' => $made['made_name'],
                        'cnic_no' => $made['made_cnic'],
                        'mobile_no' => $made['made_mobile'],
                        'security_clearance' => isset($made['made_security_clearance']),
                        'blacklist' => isset($made['made_blacklist']),
                    ]);
                }
            }
            if(!empty($request->driver)){
                UserDriver::where('p_no', $request->p_no)->delete();
                foreach($request->driver as $driver){
                    UserDriver::create([
                        'p_no' => $request['p_no'],
                        'name' => $driver['driver_name'],
                        'cnic_no' => $driver['driver_cnic'],
                        'mobile_no' => $driver['driver_mobile'],
                        'security_clearance' => isset($driver['driver_security_clearance']),
                        'blacklist' => isset($driver['driver_blacklist']),
                    ]);
                }
            }
            if(!empty($request->chef)){
                UserChef::where('p_no', $request->p_no)->delete();
                foreach($request->chef as $chef){
                    UserChef::create([
                        'p_no' => $request['p_no'],
                        'name' => $chef['chef_name'],
                        'cnic_no' => $chef['chef_cnic'],
                        'mobile_no' => $chef['chef_mobile'],
                        'security_clearance' => isset($chef['chef_security_clearance']),
                        'blacklist' => isset($chef['chef_blacklist']),
                    ]);
                }
            }
            if(!empty($request->gardener)){
                UserGardener::where('p_no', $request->p_no)->delete();
                foreach($request->gardener as $gardener){
                    UserGardener::create([
                        'p_no' => $request['p_no'],
                        'name' => $gardener['gardener_name'],
                        'cnic_no' => $gardener['gardener_cnic'],
                        'mobile_no' => $gardener['gardener_mobile'],
                        'security_clearance' => isset($gardener['gardener_security_clearance']),
                        'blacklist' => isset($gardener['gardener_blacklist']),
                    ]);
                }
            }
        }else{
            if(!empty($request->wife)){
                foreach($request->wife as $wife){
                    UserWife::create([
                        'p_no' => $request['p_no'],
                        'name' => $wife['wife_name'],
                        'cnic_no' => $wife['wife_cnic'],
                        'mobile_no' => $wife['wife_mobile'],
                        'security_clearance' => isset($wife['wife_security_clearance']),
                        'blacklist' => isset($wife['wife_blacklist']),
                    ]);
                }
            }
            if(!empty($request->children)){
                foreach($request->children as $child){
                    UserChild::create([
                        'p_no' => $request['p_no'],
                        'name' => $child['child_name'],
                        'age' => $child['child_age'],
                        'gender' => $child['child_gender'],
                        'security_clearance' => isset($child['child_security_clearance']),
                        'blacklist' => isset($child['child_blacklist']),
                    ]);
                }
            }
            if(!empty($request->made)){
                foreach($request->made as $made){
                    UserMade::create([
                        'p_no' => $request['p_no'],
                        'name' => $made['made_name'],
                        'cnic_no' => $made['made_cnic'],
                        'mobile_no' => $made['made_mobile'],
                        'security_clearance' => isset($made['made_security_clearance']),
                        'blacklist' => isset($made['made_blacklist']),
                    ]);
                }
            }
            if(!empty($request->driver)){
                foreach($request->driver as $driver){
                    UserDriver::create([
                        'p_no' => $request['p_no'],
                        'name' => $driver['driver_name'],
                        'cnic_no' => $driver['driver_cnic'],
                        'mobile_no' => $driver['driver_mobile'],
                        'security_clearance' => isset($driver['driver_security_clearance']),
                        'blacklist' => isset($driver['driver_blacklist']),
                    ]);
                }
            }
            if(!empty($request->chef)){
                foreach($request->chef as $chef){
                    UserChef::create([
                        'p_no' => $request['p_no'],
                        'name' => $chef['chef_name'],
                        'cnic_no' => $chef['chef_cnic'],
                        'mobile_no' => $chef['chef_mobile'],
                        'security_clearance' => isset($chef['chef_security_clearance']),
                        'blacklist' => isset($chef['chef_blacklist']),
                    ]);
                }
            }
            if(!empty($request->gardener)){
                foreach($request->gardener as $gardener){
                    UserGardener::create([
                        'p_no' => $request['p_no'],
                        'name' => $gardener['gardener_name'],
                        'cnic_no' => $gardener['gardener_cnic'],
                        'mobile_no' => $gardener['gardener_mobile'],
                        'security_clearance' => isset($gardener['gardener_security_clearance']),
                        'blacklist' => isset($gardener['gardener_blacklist']),
                    ]);
                }
            }

            Session::flash('flash_message', 'Task successfully added!');
        }
        return back();
    }

    public function downloadForm($id)
    {
        $model = AllotteeParticular::where('id', $id)->first();

        $pdf = PDF::loadView('allotteeParticular.download-form', compact('model'));
        return $pdf->download('Pnwhs.pdf');
    }

    public function downloadImage($image_name)
    {
        if(!empty($image_name)){
            $filepath = public_path('alloteefiles/').$image_name;
            return Response::download($filepath);
        }
    }

    public function downloadKinsDoc($image_name)
    {
        if(!empty($image_name)){
            $filepath = public_path('kinsfiles/').$image_name;
            return Response::download($filepath);
        }
    }

    public function calculateService(Request $request)
    {
        $start_date = date_create($request->probation_date);
        $end_date = date_create($request->sos_date);
        $diff = date_diff($end_date, $start_date);
        return response()->json(['years'=>$diff->y,'months'=>$diff->m, 'days'=>$diff->d]);
    }

    public function deleteMembershipApplication($id)
    {
        $model = AllotteeParticular::where('p_no', $id)->delete();
        if($model){
            AllotteeDetailsOfKin::where('p_no', $id)->delete();
            Alloteefiles::where('p_no', $id)->delete();
            Kinsmultiplefile::where('p_no', $id)->delete();
            return 1;
        }
    }
}

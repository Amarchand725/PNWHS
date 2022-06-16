<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\CsvFile;
use App\CsvRawFile;
use App\CsvData;
use App\CsvRawData;
use App\Userroles;
use App\Users;
use App\AllotteeParticular;
use App\PromotedMember;
use App\Rank;
use App\Payment;
use Session;
use Auth;
use Response;
use Illuminate\Support\Facades\Input;
use DB;

class CsvFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new CsvFile;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = CsvFile::Search();
        }else{
           $models =  CsvFile::orderby('id', 'DESC')->paginate(10);
        }
        
        if (\Request::ajax()) {

            return view('csvFile.ajax',  compact('models'));
        }
    	
        return view('csvFile.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('csvFile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $csv_raw_file = CsvRawFile::where('id', $request->csv_file_id)->first();
        $members_paid = CsvRawData::groupBy('pjo')
        ->where('raw_file_id', $csv_raw_file->id)
        ->selectRaw('sum(monthly_amount) as sum, pjo')
        ->pluck('sum','pjo');

        if(!empty($csv_raw_file)){
            $csv_raw_data = CsvRawData::whereIn('pjo', $request->records)->where('raw_file_id', $csv_raw_file->id)->get();
            $csv_file = CsvFile::create([
                'file_name' => $csv_raw_file->file_name,
                'created_by' => Auth::user()->id,
            ]);

            foreach($csv_raw_data as $record){
                $registered = AllotteeParticular::where('p_no', $record->pjo)->first();

                if($record->monthly_amount != null || $record->reg_fee != null || $record->insurance != null){
                    CsvData::create([
                        'csv_file_id' => $csv_file->id,
                        'is_member' => $registered != ''??'1',
                        'p_no' => $record->pjo,
                        'rank' => $record->rank,
                        'name' => $record->name,
                        'amount' => $record->monthly_amount,
                        'reg_fee' => $record->reg_fee,
                        'insurance_payment' => $record->insurance,
                        'month' => $record->date=='January-1970'?date('d,M-Y',strtotime($record->date)):$record->date,
                    ]);

                    $member_details = '';
                    $ifpromoted = PromotedMember::where('new_p_no', $record->pjo)->first();
                    if($ifpromoted){
                        $ifexist = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $ifpromoted->old_p_no)->first();
                    }else{
                        $ifexist = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('p_no', $record->pjo)->first();
                    }
                    if(!empty($ifexist)){
                        $member_details = $ifexist;
                    }else{
                        $rank = Rank::where('name', $record->rank)->first();
                        $inserted = AllotteeParticular::create([
                            'created_by' => Auth::user()->id,
                            'membership_date' => date('d-m-Y'),
                            'p_no' => $record->pjo,
                            'rank_rate' => $rank->id??null,
                            'name' => $record->name??null,
                            'date' => date('d-m-Y'),
                            'seen' => 1,
                            'form_status' => 0,
                            'status' => 0,
                        ]);
                        
                        $inserted = AllotteeParticular::with('hasUser', 'hasRank', 'hasRank.hasPolicy.hasPaymentPolicy')->where('id', $inserted->id)->first();

                        $member_details = $inserted;
                    }

                    $voucher_no = '';
                    do {
                        $voucher_no = mt_rand( 1000, 9999 );
                    } while ( DB::table( 'payment' )->where( 'voucher_no', $voucher_no )->exists() );

                    $member_payment = Payment::where('p_no', $member_details->p_no)->orderby('id', 'DESC')->first();

                    if(empty($member_payment)){
                        $total_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment+$member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment;  
                        $total_paid_amount = (int)$record->monthly_amount+(int)$record->reg_fee+(int)$record->insurance;
                        if($total_paid_amount<$total_amount){
                            $amount = $total_paid_amount-$total_amount;
                            Payment::create([
                                'p_no' => $member_details->p_no,
                                'member_id' => $member_details->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $total_amount,
                                'submitted_amount' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => $record->date,
                                'instrument_no' => null,
                                'remarks' => null,
                            ]);
                        }else if($total_paid_amount==$total_amount){
                            $amount = $total_paid_amount-$total_amount;
                            $monthly_install = $amount-$member_details->hasRank->has_policy->has_payment_policy->monthly_instalment;
                            Payment::create([
                                'p_no' => $member_details->p_no,
                                'member_id' => $member_details->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $total_amount,
                                'submitted_amount' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => $record->date,
                                'instrument_no' => null,
                                'remarks' => null,
                                'is_active' => 1,
                            ]);
                        }else{
                            $amount = $total_paid_amount-$total_amount;
                            Payment::create([
                                'p_no' => $member_details->p_no,
                                'member_id' => $member_details->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $total_amount,
                                'sub_monthly_install' => $amount,
                                'submitted_amount' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => $record->date,
                                'instrument_no' => null,
                                'remarks' => null,
                                'is_active' => 1,
                            ]);
                        }
                    }elseif($member_details->plotassigned==1){
                        Payment::create([
                            'p_no' => $member_details->p_no,
                            'member_id' => $member_details->id,
                            'voucher_no' => $voucher_no,
                            'payment_type' => 'sheet',
                            'total_amount' => $last_amount,
                            'sub_monthly_install' => $total_paid_amount,
                            'current_paid' => $total_paid_amount,
                            'amount' => $amount,
                            'bank_name' => null,
                            'deposit_date' => $record->date,
                            'instrument_no' => null,
                            'remarks' => null,
                            'is_active' => 1,
                        ]);
                    }else{
                        if($member_payment->is_active==0){
                            if($record->monthly_amount < abs($member_payment->amount)){
                                $amount = $record->monthly_amount+$member_payment->amount;
                                Payment::create([
                                    'p_no' => $member_details->p_no,
                                    'member_id' => $member_details->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $member_payment->amount,
                                    'submitted_amount' => $record->monthly_amount,
                                    'current_paid' => $record->monthly_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => null,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                ]);
                            }else if($record->monthly_amount == abs($member_payment->amount)){
                                $amount = $record->monthly_amount+$member_payment->amount;
                                Payment::create([
                                    'p_no' => $member_details->p_no,
                                    'member_id' => $member_details->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $member_payment->amount,
                                    'submitted_amount' => $record->monthly_amount,
                                    'current_paid' => $record->monthly_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => null,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }else if($record->monthly_amount > abs($member_payment->amount)){
                                $amount = $record->monthly_amount+$member_payment->amount;

                                Payment::create([
                                    'p_no' => $member_details->p_no,
                                    'member_id' => $member_details->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $member_payment->amount,
                                    'submitted_amount' => abs($member_payment->amount),
                                    'current_paid' => $record->monthly_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => null,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                ]);
                            }
                        }else if($member_payment->is_active==1){
                            $total_paid_amount = (int)$record->monthly_amount+(int)$record->reg_fee+(int)$record->insurance;
                            $active_from = Payment::where('p_no', $member_details->p_no)->where('is_active', 1)->first();
                            $m_active_from = strtotime($active_from->created_at);
                            $current = strtotime(now());

                            $active_year = date('Y', $m_active_from);
                            $current_year = date('Y', $current);

                            $active_month = date('m', $m_active_from);
                            $current_month = date('m', $current);

                            $total_active_months = (($current_year - $active_year) * 12) + ($current_month - $active_month);
                            $total_active_months_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment*$total_active_months;
                            $total_paid_installs = Payment::where('p_no', $record->pjo)->where('is_active', 1)->sum('sub_monthly_install');
                            $last_amount = $total_paid_installs-$total_active_months_amount;
                            $amount = $total_paid_amount+$last_amount;

                            Payment::create([
                                'p_no' => $member_details->p_no,
                                'member_id' => $member_details->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $last_amount,
                                'sub_monthly_install' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => null,
                                'instrument_no' => null,
                                'remarks' => null,
                                'is_active' => 1,
                            ]);
                        }
                    }
                }
            }
        }else{
            return redirect()->back();
        }
        
	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect('CsvFile');
    }

    public function deleteUplodatedFile($id)
    {
        $deleted = CsvFile::where('id', $id)->delete();
        if($deleted){
            CsvData::where('csv_file_id', $id)->delete(); 
            return 1;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $model = CsvFile::with('hasData')->findOrFail($id);
      	return view('csvFile.show', array('model' => $model));
    }

    public function registerMembers(Request $request)
    {
        $user_role = Userroles::where('role', 'user')->first();
        $inserted = Users::create([
            'role' => $user_role->id, 
            'created_by' => Auth::user()->id, 
            'p_no' => $request['p_no'], 
            'email' => $request['p_no'],
            'password' => bcrypt($request['p_no'])
        ]);

        if($inserted){
            $inserted = AllotteeParticular::create([
                'p_no' => $request['p_no'],
                'created_by' => Auth::user()->id,
                'created' => date('d-m-Y'),
            ]);
        }
    }

    public function importFile(Request $request)
    {
        // 
        return view('import');
    }

    public function parseFile(CsvImportRequest $request)
    {
        // $rules = ([
        //     'file'=>'required|mimetypes:application/csv,application/excel, application/vnd.ms-excel, application/vnd.msexcel,
        //     text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        // ]);
        // $this->validate($request, $rules);

        $path = $request->file('csv_file')->getRealPath();
        $data = Excel::load($path)->get();
        if (count($data) > 0) {
            $csv_data = array_slice($data->toArray(), 1,1);
            foreach($csv_data as $key=>$csv){
                $month_records = array_slice($csv_data[$key], 7);
            }
            $csv_raw_file = CsvRawFile::create([
                'file_name' => $request->file('csv_file')->getClientOriginalName(),
                'created_by' => Auth::user()->id,
            ]);

            $total_registered_members = array();
            $total_unregistered_members = array();
            $count_conflects = array();
            $temp_arr = [];

            foreach($data->toArray() as $k => $record){
                $p_no = 0;
                $ifexist = PromotedMember::where('new_p_no', (int)$record['pjo'])->first();
                if($ifexist){
                    $registered = AllotteeParticular::where('p_no', $ifexist->old_p_no)->first();
                }else{
                    $registered = AllotteeParticular::where('p_no', (int)$record['pjo'])->first();
                }
                if(!empty($registered)){
                    $total_registered_members[] = (int)$record['pjo'];
                }else{
                    $total_unregistered_members[] = (int)$record['pjo'];
                }
                
                @$count_conflects[$record['pjo']]++; 
            }

            foreach($month_records as $key=>$record){
                foreach($data->toArray() as $k => $record){
                    // if($record[$key] != '' || $record['reg_fee'] != '' || $record['insurance'] != ''){
                    //     $ifexist = CsvRawData::where('pjo', $record['pjo'])->Where('reg_fee', '!=', '')->Where('insurance', '!=', '')->first();
                        
                    //     if(empty($ifexist)){
                        if($record[$key] != '' || $record[$key] != null){
                            $csv_raw_data = CsvRawData::create([
                                'raw_file_id' => $csv_raw_file->id,
                                's_no' => $record['s_no'],
                                'rank' => $record['rank'],
                                'name' => $record['name'],
                                'cat' => $record['cat'],
                                'pjo' => (int)$record['pjo'],
                                'p_no_for_hony' => $record['p_no_for_hony'],
                                'g_r' => $record['g_r'],
                                // 'reg_fee' => $record['reg_fee'],
                                // 'insurance' => $record['insurance'],
                                // 'dd_date' => $record['dd_date'],
                                // 'dep_date' => $record['dep_date'],
                                // 'date' => $record['date'],
                                'month' => $key,
                                'monthly_amount' => $record[$key],
                                // 'reg_insurance' => $record['reg_fee']+$record['insurance'],
                                // 'g_total_w_o_reg_ins' => $record[$key],
                            ]);  
                        }
                        // }else{
                        //     if($record[$key] != '' || $record[$key] != null){
                        //         $csv_raw_data = CsvRawData::create([
                        //             'raw_file_id' => $csv_raw_file->id,
                        //             's_no' => $record['s_no'],
                        //             'cat_no' => $record['cat_no'],
                        //             'rank' => $record['rank'],
                        //             'name' => $record['name'],
                        //             'cat' => $record['cat'],
                        //             'pjo' => (int)$record['pjo'],
                        //             'p_no_for_hony' => $record['p_no_for_hony'],
                        //             'g_r' => $record['g_r'],
                        //             'dd_date' => $record['dd_date'],
                        //             'dep_date' => $record['dep_date'],
                        //             'date' => $record['date'],
                        //             'month' => $key,
                        //             'monthly_amount' => $record[$key],
                        //             'g_total_w_o_reg_ins' => $record[$key],
                        //         ]); 
                        //     }   
                        // }              
                    // }
                }
            }

            $csv_raw_file_id = $csv_raw_file->id;
            return view('import_fields', compact('total_registered_members', 'total_unregistered_members', 'count_conflects', 'csv_raw_file_id'));
        } else {
            return redirect()->back();
        }
    }

    public function downloadSheetSample()
    {
        $filepath = public_path('sheet-sample/sample.xlsx');
        return Response::download($filepath);
    }

    public function processFile(Request $request)
    {
        // return $request;
        $csv_raw_file = CsvRawFile::where('id', $request->csv_raw_file_id)->first();

        $members_paid = CsvRawData::groupBy('pjo')
        ->where('raw_file_id', $csv_raw_file->id)
        ->selectRaw('sum(monthly_amount) as sum, pjo')
        ->pluck('sum','pjo');

        $csv_raw_file_id = $csv_raw_file->id;
        $submit_name = $request->submit;
        if(!empty($csv_raw_file)){
            $members = [];
            if($request->submit=='registered-list'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifpromoted = PromotedMember::where('new_p_no', $val['pjo'])->first();
                    if($ifpromoted){
                        $ifexist = AllotteeParticular::where('p_no', $ifpromoted->old_p_no)->first();
                    }else{
                        $ifexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    }
                    
                    if(!empty($ifexist)){
                        $members[] = $val;
                    }
                }

                return view('csvFile.create', compact('members', 'members_paid', 'submit_name', 'csv_raw_file_id'));
            }elseif($request->submit=='registered-save'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifpromoted = PromotedMember::where('new_p_no', $val['pjo'])->first();
                    if($ifpromoted){
                        $ifexist = AllotteeParticular::where('p_no', $ifpromoted->old_p_no)->first();
                    }else{
                        $ifexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    }
                    if($ifexist){
                        $members[] = $val;
                    }
                }

                if(!empty($members)){
                    $csv_file = CsvFile::create([
                        'file_name' => $csv_raw_file->file_name,
                        'created_by' => Auth::user()->id,
                    ]);
                    
                    foreach($members as $record){
                        CsvData::create([
                            'csv_file_id' => $csv_file->id,
                            'is_member' => 1,
                            'p_no' => $record->pjo,
                            'amount' => $record['monthly_amount'],
                            'month' => date('F-Y', strtotime($record['date']))??'--',
                        ]);

                        $voucher_no = '';
                        do {
                            $voucher_no = mt_rand( 1000, 9999 );
                        } while ( DB::table( 'payment' )->where( 'voucher_no', $voucher_no )->exists() );

                        $member_payment = Payment::where('p_no', $record->pjo)->orderby('id', 'DESC')->first();

                        if(empty($member_payment)){
                            $total_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment+$member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment;  
                            $total_paid_amount = (int)$record->monthly_amount+(int)$record->reg_fee+(int)$record->insurance;
                            if($total_paid_amount<$total_amount){
                                $amount = $total_paid_amount-$total_amount;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                ]);
                            }else if($total_paid_amount==$total_amount){
                                $amount = $total_paid_amount-$total_amount;
                                $monthly_install = $amount-$member_details->hasRank->has_policy->has_payment_policy->monthly_instalment;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }else{
                                $amount = $total_paid_amount-$total_amount;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'sub_monthly_install' => $amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }
                        }elseif($record->plotassigned==1){
                            Payment::create([
                                'p_no' => $record->pjo,
                                'member_id' => $record->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $last_amount,
                                'sub_monthly_install' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => $record->date,
                                'instrument_no' => null,
                                'remarks' => null,
                                'is_active' => 1,
                            ]);
                        }else{
                            if($member_payment->is_active==0){
                                if($record->monthly_amount < abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;
                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => $record->monthly_amount,
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                    ]);
                                }else if($record->monthly_amount == abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;
                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => $record->monthly_amount,
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                        'is_active' => 1,
                                    ]);
                                }else if($record->monthly_amount > abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;

                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => abs($member_payment->amount),
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                    ]);
                                }
                            }else if($member_payment->is_active==1){
                                $active_from = Payment::where('p_no', $record->pjo)->where('is_active', 1)->first();
                                $m_active_from = strtotime($active_from->created_at);
                                $current = strtotime(now());

                                $active_year = date('Y', $m_active_from);
                                $current_year = date('Y', $current);

                                $active_month = date('m', $m_active_from);
                                $current_month = date('m', $current);

                                $total_active_months = (($current_year - $active_year) * 12) + ($current_month - $active_month);
                                $total_active_months_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment*$total_active_months;
                                $total_paid_installs = Payment::where('p_no', $record->pjo)->where('is_active', 1)->sum('sub_monthly_install');
                                $last_amount = $total_paid_installs-$total_active_months_amount;
                                $amount = $total_paid_amount+$last_amount;

                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $last_amount,
                                    'sub_monthly_install' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => null,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }
                        }
                    }
                }

                Session::flash('flash_message', 'Task successfully saved!');

                return redirect('CsvFile');
                
            }elseif($request->submit=='unregistered-list'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifpromoted = PromotedMember::where('new_p_no', $val['pjo'])->first();
                    if($ifpromoted){
                        $ifnotexist = AllotteeParticular::where('p_no', $ifpromoted->old_p_no)->first();
                    }else{
                        $ifnotexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    }
                    if(empty($ifnotexist)){
                        $members[] = $val;
                    }
                }

                return view('csvFile.create', compact('members', 'members_paid', 'submit_name', 'csv_raw_file_id'));

            }elseif($request->submit=='unregistered-save'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifpromoted = PromotedMember::where('new_p_no', $val['pjo'])->first();
                    if($ifpromoted){
                        $ifnotexist = AllotteeParticular::where('p_no', $ifpromoted->old_p_no)->first();
                    }else{
                        $ifnotexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    }
                    if(empty($ifnotexist)){
                        $members[] = $val;
                    }
                }
                if(!empty($members)){
                    $csv_file = CsvFile::create([
                        'file_name' => $csv_raw_file->file_name,
                        'created_by' => Auth::user()->id,
                    ]);

                    foreach($members as $record){
                        CsvData::create([
                            'csv_file_id' => $csv_file->id,
                            'is_member' => 1,
                            'p_no' => $record['pjo'],
                            'amount' => $record['monthly_amount'],
                            'month' => date('F-Y', strtotime($record['date']))??'--',
                        ]);

                        $user_rec = Users::findOFail($record['pjo']);
                        if(empty($user_rec)){
                            $user_role = Userroles::where('role', 'user')->first();
                            $inserted = Users::create([
                                'role' => $user_role->id, 
                                'created_by' => Auth::user()->id, 
                                'p_no' => $record['pjo'], 
                                'email' => $record['pjo'],
                                'password' => bcrypt($record['pjo'])
                            ]);
                        }

                        $rank = Rank::where('name', $record->rank)->first();
                        $inserted = AllotteeParticular::create([
                            'created_by' => Auth::user()->id,
                            'membership_date' => date('d-m-Y'),
                            'p_no' => $record->pjo,
                            'rank_rate' => $rank->id??null,
                            'name' => $record->name??null,
                            'date' => date('d-m-Y'),
                            'seen' => 1,
                            'form_status' => 0,
                            'status' => 0,
                        ]);

                        $member_details = $inserted;
                        
                        $voucher_no = '';
                        do {
                            $voucher_no = mt_rand( 1000, 9999 );
                        } while ( DB::table( 'payment' )->where( 'voucher_no', $voucher_no )->exists() );

                        $member_payment = Payment::where('p_no', $record->pjo)->orderby('id', 'DESC')->first();

                        if(empty($member_payment)){
                            $total_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment+$member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment;  
                            $total_paid_amount = (int)$record->monthly_amount+(int)$record->reg_fee+(int)$record->insurance;
                            if($total_paid_amount<$total_amount){
                                $amount = $total_paid_amount-$total_amount;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                ]);
                            }else if($total_paid_amount==$total_amount){
                                $amount = $total_paid_amount-$total_amount;
                                $monthly_install = $amount-$member_details->hasRank->has_policy->has_payment_policy->monthly_instalment;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }else{
                                $amount = $total_paid_amount-$total_amount;
                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $total_amount,
                                    'sub_monthly_install' => $amount,
                                    'submitted_amount' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => $record->date,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }
                        }elseif($record->plotassigned==1){
                            return 'working';
                            Payment::create([
                                'p_no' => $record->pjo,
                                'member_id' => $record->id,
                                'voucher_no' => $voucher_no,
                                'payment_type' => 'sheet',
                                'total_amount' => $last_amount,
                                'sub_monthly_install' => $total_paid_amount,
                                'current_paid' => $total_paid_amount,
                                'amount' => $amount,
                                'bank_name' => null,
                                'deposit_date' => $record->date,
                                'instrument_no' => null,
                                'remarks' => null,
                                'is_active' => 1,
                            ]);
                        }else{
                            if($member_payment->is_active==0){
                                if($record->monthly_amount < abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;
                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => $record->monthly_amount,
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                    ]);
                                }else if($record->monthly_amount == abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;
                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => $record->monthly_amount,
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                        'is_active' => 1,
                                    ]);
                                }else if($record->monthly_amount > abs($member_payment->amount)){
                                    $amount = $record->monthly_amount+$member_payment->amount;

                                    Payment::create([
                                        'p_no' => $record->pjo,
                                        'member_id' => $record->id,
                                        'voucher_no' => $voucher_no,
                                        'payment_type' => 'sheet',
                                        'total_amount' => $member_payment->amount,
                                        'submitted_amount' => abs($member_payment->amount),
                                        'current_paid' => $record->monthly_amount,
                                        'amount' => $amount,
                                        'bank_name' => null,
                                        'deposit_date' => null,
                                        'instrument_no' => null,
                                        'remarks' => null,
                                    ]);
                                }
                            }else if($member_payment->is_active==1){
                                $active_from = Payment::where('p_no', $record->pjo)->where('is_active', 1)->first();
                                $m_active_from = strtotime($active_from->created_at);
                                $current = strtotime(now());

                                $active_year = date('Y', $m_active_from);
                                $current_year = date('Y', $current);

                                $active_month = date('m', $m_active_from);
                                $current_month = date('m', $current);

                                $total_active_months = (($current_year - $active_year) * 12) + ($current_month - $active_month);
                                $total_active_months_amount = $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment*$total_active_months;
                                $total_paid_installs = Payment::where('p_no', $record->pjo)->where('is_active', 1)->sum('sub_monthly_install');
                                $last_amount = $total_paid_installs-$total_active_months_amount;
                                $amount = $total_paid_amount+$last_amount;

                                Payment::create([
                                    'p_no' => $record->pjo,
                                    'member_id' => $record->id,
                                    'voucher_no' => $voucher_no,
                                    'payment_type' => 'sheet',
                                    'total_amount' => $last_amount,
                                    'sub_monthly_install' => $total_paid_amount,
                                    'current_paid' => $total_paid_amount,
                                    'amount' => $amount,
                                    'bank_name' => null,
                                    'deposit_date' => null,
                                    'instrument_no' => null,
                                    'remarks' => null,
                                    'is_active' => 1,
                                ]);
                            }
                        }
                    }
                }

                Session::flash('flash_message', 'Task successfully saved!');

	            return redirect('CsvFile');
            }elseif($request->submit=='conflected-list'){
                $conflected_records = array();
                foreach($csv_raw_file->hasRawData as $val){
                    $members[] = $val;
                    @$conflected_records[$val['pjo']]++;
                }

                return view('csvFile.create', compact('members', 'members_paid', 'conflected_records', 'submit_name'));
            } 
        }else {
            return redirect()->back();
        }
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
        $model = CsvFile::findOrFail($id);
        return view('csvFile.edit')->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get()->toArray();
        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 2);
            $csv_file = CsvFile::where('id', $id)->update([
                'file_name' => $request->file('csv_file')->getClientOriginalName(),
                'created_by' => Auth::user()->id,
            ]);

            if($csv_file){
                CsvData::where('csv_file_id', $id)->delete();

                foreach($csv_data as $record){
                    CsvData::create([
                        'csv_file_id' => $id,
                        'p_no' => (int)$record['p_no'],
                        'submitted_amount' => $record['amount'],
                        'submitted_date' => date('d, F-Y', strtotime($record['date'])),
                    ]);
                }
            }
        } else {
            return redirect()->back();
        }

	    Session::flash('flash_message', 'CsvFile successfully updated!');

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
        $model = CsvFile::findOrFail($id);
        $model->delete();
        
        if($model){
            CsvData::where('csv_file_id', $id)->delete();
        }

	    Session::flash('flash_message', 'CsvFile successfully deleted!');

	    return redirect()->route('csvFile.index');
    }
}

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
        $csv_raw_file = CsvRawFile::where('id', $request->csv_file_id)->first();
        if(!empty($csv_raw_file)){
            $csv_raw_data = CsvRawData::whereIn('pjo', $request->records)->where('raw_file_id', $csv_raw_file->id)->get();

            $csv_file = CsvFile::create([
                'file_name' => $csv_raw_file->file_name,
                'created_by' => Auth::user()->id,
            ]);

            foreach($csv_raw_data as $record){
                $registered = AllotteeParticular::where('p_no', $record->pjo)->first();

                CsvData::create([
                    'csv_file_id' => $csv_file->id,
                    'is_member' => $registered != ''??'1',
                    'p_no' => $record->pjo,
                    'rank' => $record->rank,
                    'name' => $record->name,
                    'amount' => $record->monthly_amount,
                    'month' => $record->date=='January-1970'?date('d,M-Y',strtotime($record->date)):$record->date,
                ]);
            }
        }else{
            return redirect()->back();
        }
        
	    Session::flash('flash_message', 'Task successfully added!');

	    return redirect('CsvFile');
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
                $month_records = array_slice($csv_data[$key], 14);
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
                $registered = AllotteeParticular::where('p_no', $record['pjo'])->first();
                if(!empty($registered)){
                    $total_registered_members[] = $record['pjo'];
                }else{
                    $total_unregistered_members[] = $record['pjo'];
                }
                
                @$count_conflects[$record['pjo']]++; 
            }

            foreach($month_records as $key=>$record){
                foreach($data->toArray() as $k => $record){
                    if($record[$key] || $record['reg_fee'] != '' || $record['insurance'] != ''){
                        
                        $ifexist = CsvRawData::where('pjo', $record['pjo'])->Where('reg_fee', '!=', '')->Where('insurance', '!=', '')->first();
                        if(empty($ifexist)){
                            $csv_raw_data = CsvRawData::create([
                                'raw_file_id' => $csv_raw_file->id,
                                's_no' => $record['s_no'],
                                'cat_no' => $record['cat_no'],
                                'rank' => $record['rank'],
                                'name' => $record['name'],
                                'cat' => $record['cat'],
                                'pjo' => $record['pjo'],
                                'p_no_for_hony' => $record['p_no_for_hony'],
                                'g_r' => $record['g_r'],
                                'reg_fee' => $record['reg_fee'],
                                'insurance' => $record['insurance'],
                                'dd_date' => $record['dd_date'],
                                'dep_date' => $record['dep_date'],
                                'date' => $record['date'],
                                'month' => $key,
                                'monthly_amount' => $record[$key],
                                'reg_insurance' => $record['reg_fee']+$record['insurance'],
                                'g_total_w_o_reg_ins' => $record[$key],
                            ]);  
                        }else{
                            $csv_raw_data = CsvRawData::create([
                                'raw_file_id' => $csv_raw_file->id,
                                's_no' => $record['s_no'],
                                'cat_no' => $record['cat_no'],
                                'rank' => $record['rank'],
                                'name' => $record['name'],
                                'cat' => $record['cat'],
                                'pjo' => $record['pjo'],
                                'p_no_for_hony' => $record['p_no_for_hony'],
                                'g_r' => $record['g_r'],
                                'dd_date' => $record['dd_date'],
                                'dep_date' => $record['dep_date'],
                                'date' => $record['date'],
                                'month' => $key,
                                'monthly_amount' => $record[$key],
                                'g_total_w_o_reg_ins' => $record[$key],
                            ]);    
                        }                    
                    }
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
                    $ifexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    if(!empty($ifexist)){
                        $members[] = $val;
                    }
                }

                return view('csvFile.create', compact('members', 'members_paid', 'submit_name', 'csv_raw_file_id'));
            }elseif($request->submit=='registered-save'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
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
                            'p_no' => $record['pjo'],
                            'amount' => $record['monthly_amount'],
                            'month' => date('F-Y', strtotime($record['date']))??'--',
                        ]);
                    }
                }

                Session::flash('flash_message', 'Task successfully saved!');

                return redirect('CsvFile');
                
            }elseif($request->submit=='unregistered-list'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifnotexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    if(empty($ifnotexist)){
                        $members[] = $val;
                    }
                }

                return view('csvFile.create', compact('members', 'members_paid', 'submit_name', 'csv_raw_file_id'));

            }elseif($request->submit=='unregistered-save'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifnotexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
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
                    }
                }

                Session::flash('flash_message', 'Task successfully saved!');

	            return redirect('CsvFile');
            }elseif($request->submit=='unregistered-save-register'){
                foreach($csv_raw_file->hasRawData as $val){
                    $ifnotexist = AllotteeParticular::where('p_no', $val['pjo'])->first();
                    if(empty($ifnotexist)){
                        $user_role = Userroles::where('role', 'user')->first();
                        $inserted = Users::create([
                            'role' => $user_role->id, 
                            'created_by' => Auth::user()->id, 
                            'p_no' => $val['pjo'], 
                            'email' => $val['pjo'],
                            'password' => bcrypt($val['pjo'])
                        ]);

                        if($inserted){
                            $inserted = AllotteeParticular::create([
                                'p_no' => $val['pjo'],
                                'created_by' => Auth::user()->id,
                                'created' => date('d-m-Y'),
                            ]);
                        }

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
                    }
                }

                Session::flash('flash_message', 'Task successfully saved & registered!');
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

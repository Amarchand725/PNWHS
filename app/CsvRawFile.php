<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CsvRawFile extends Model
{
    
	protected $table = 'csv_raw_files';
	  
	protected $fillable = [
        'id','file_name','created_by','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'file_name' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Csv_Raw_File::table('Csv_Raw_File'); // it will also work , make sure table case is correct
    	$query = Csv_Raw_File::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("file_name"))){
    			$query->where("file_name","=",Input::get("file_name"));
    			} 
if(!empty(Input::get("created_by"))){
    			$query->where("created_by","=",Input::get("created_by"));
    			} 
if(!empty(Input::get("created_at"))){
    			$query->where("created_at","=",Input::get("created_at"));
    			} 
if(!empty(Input::get("updated_at"))){
    			$query->where("updated_at","=",Input::get("updated_at"));
    			} 
		//$result = $query->get();
		$result = $query->paginate(2);
		//print_r($result);die();
		return $result;
	}
	
	public function hasUserCreatedBy()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function hasRawData()
	{
		return $this->hasMany(CsvRawData::class, 'raw_file_id', 'id')->groupby('pjo');
	}
}
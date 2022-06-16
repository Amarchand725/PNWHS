<?php 
namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plot extends Model
{
	protected $table = 'plots';
	  
	protected $fillable = [
        'id','plot_no','type','phase','image','personel_type','features','size','block','amount','created_at','updated_at'
    ];

	static function getValidationRules(){
    	$rules = [
		    'plot_no' => 'required', 'type' => 'required', 'phase' => 'required', 'personel_type' => 'required'
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = Plot::table('Plot'); // it will also work , make sure table case is correct
    	$query = Plot::where('id','>',0);

			if(!empty(Input::get("id"))){
    			$query->where("id","=",Input::get("id"));
    			} 
if(!empty(Input::get("plot_no"))){
    			$query->where("plot_no","=",Input::get("plot_no"));
    			} 
if(!empty(Input::get("type"))){
    			$query->where("type","=",Input::get("type"));
    			} 
if(!empty(Input::get("size"))){
    			$query->where("size","=",Input::get("size"));
				} 
				if(!empty(Input::get("plot_status"))){
					$query->where("plot_status","=",Input::get("plot_status"));
					} 
if(!empty(Input::get("block"))){
    			$query->where("block","=",Input::get("block"));
    			} 
if(!empty(Input::get("amount"))){
    			$query->where("amount","=",Input::get("amount"));
    			} 
		//$result = $query->get();
		$result = $query->paginate(10);
		//print_r($result);die();
		return $result;
	}
	
	public function hasConstruction()
	{
		return $this->hasOne(Construction::class, 'plot_id', 'id');
	}

	public function hasSize(){
		return $this->hasOne(Size::class, 'id', 'size')->withDefault([
            'name' => 'N/A'
        ]);
	}
}
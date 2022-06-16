namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class {modelName} extends Model
{
    
	protected $table = '{tableName}';
	  
	protected $fillable = [
        {fieldsNameOnly}
    ];

	static function getValidationRules(){
    	$rules = [
		    {rules}
		];
		return $rules;
    }

		static function Search(){
    	$pageSize = (isset($_GET['pageSize'])?$_GET['pageSize']:15);
    	//$query = {modelName}::table('{modelName}'); // it will also work , make sure table case is correct
    	$query = {modelName}::where('id','>',0);

			{conditions}

    	
    	
		//$result = $query->get();
		$result = $query->paginate(2);
		//print_r($result);die();
		return $result;

    }
}

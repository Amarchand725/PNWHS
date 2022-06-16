namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{modelName};
use Session;
use Illuminate\Support\Facades\Input;

class {ControllerName} extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new {modelName};
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = {modelName}::Search();
        }else{
           $models =  {modelName}::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('{viewFolderName}.ajax',  compact('models'));
        }

    	
        return view('{viewFolderName}.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('{viewFolderName}.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, {modelName}::getValidationRules());

        $input = $request->all();
	    {modelName}::create($input);

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
       
        $model = {modelName}::findOrFail($id);
       
      	return view('{viewFolderName}.show', array('model' => $model));
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
         $model = {modelName}::findOrFail($id);

    return view('{viewFolderName}.edit')->withModel($model);
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
       $model = {modelName}::findOrFail($id);

	    $this->validate($request, {modelName}::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', '{modelName} successfully updated!');

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
        $model = {modelName}::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', '{modelName} successfully deleted!');

	    return redirect()->route('{viewFolderName}.index');
    }
}

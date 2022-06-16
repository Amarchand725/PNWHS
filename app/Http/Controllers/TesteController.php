<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teste;
use Session;
use Illuminate\Support\Facades\Input;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Teste;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Teste::Search();
        }else{
           $models =  Teste::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('teste.ajax',  compact('models'));
        }

    	
        return view('teste.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('teste.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Teste::getValidationRules());

        $input = $request->all();
	    Teste::create($input);

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
       
        $model = Teste::findOrFail($id);
       
      	return view('teste.show', array('model' => $model));
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
         $model = Teste::findOrFail($id);

    return view('teste.edit')->withModel($model);
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
       $model = Teste::findOrFail($id);

	    $this->validate($request, Teste::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Teste successfully updated!');

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
        $model = Teste::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Teste successfully deleted!');

	    return redirect()->route('teste.index');
    }
}

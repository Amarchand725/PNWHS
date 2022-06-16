<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use Session;
use Illuminate\Support\Facades\Input;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        $formModel = new Block;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Block::Search();
        }else{
           $models =  Block::orderby('id', 'DESC')->paginate(10);
        }
                
        if (\Request::ajax()) {

            return view('block.ajax',  compact('models'));
        }

        return view('block.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('block.create');
    }

    public function blockDelete($id)
    {
        $deleted = Block::where('id', $id)->delete();
        if($deleted){
            return 1;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, Block::getValidationRules());

        $input = $request->all();
	    Block::create($input);

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
       
        $model = Block::findOrFail($id);
       
      	return view('block.show', array('model' => $model));
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
         $model = Block::findOrFail($id);

    return view('block.edit')->withModel($model);
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
       $model = Block::findOrFail($id);

	    $this->validate($request, Block::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Block successfully updated!');

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
        $model = Block::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Block successfully deleted!');

	    return redirect()->route('block.index');
    }
}

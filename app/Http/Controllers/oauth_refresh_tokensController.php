<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\oauth_refresh_tokens;
use Session;
use Illuminate\Support\Facades\Input;

class oauth_refresh_tokensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new oauth_refresh_tokens;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = oauth_refresh_tokens::Search();
        }else{
           $models =  oauth_refresh_tokens::paginate(2);
        }
        
                
        if (\Request::ajax()) {

            return view('oauth_refresh_tokens.ajax',  compact('models'));
        }

    	
        return view('oauth_refresh_tokens.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('oauth_refresh_tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        

        $this->validate($request, oauth_refresh_tokens::getValidationRules());

        $input = $request->all();
	    oauth_refresh_tokens::create($input);

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
       
        $model = oauth_refresh_tokens::findOrFail($id);
       
      	return view('oauth_refresh_tokens.show', array('model' => $model));
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
         $model = oauth_refresh_tokens::findOrFail($id);

    return view('oauth_refresh_tokens.edit')->withModel($model);
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
       $model = oauth_refresh_tokens::findOrFail($id);

	    $this->validate($request, oauth_refresh_tokens::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'oauth_refresh_tokens successfully updated!');

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
        $model = oauth_refresh_tokens::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'oauth_refresh_tokens successfully deleted!');

	    return redirect()->route('oauth_refresh_tokens.index');
    }
}

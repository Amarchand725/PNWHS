<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Input;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new Feedback;
        $formModel->fill(Input::get());
        $user = Users::where('id', Auth::user()->id)->first();
        $usertype = $user->userType->name;
        if(isset($_GET['submit'])){
            if($usertype != 'user'){
                $models = Feedback::Search($usertype);
            }
            else if($usertype == 'user'){
                $models =  Feedback::Search($usertype);
            }
        }else{
            if($usertype != 'user'){
                $models =  Feedback::paginate(10);
            }
         if($usertype == 'user'){
                $models =  Feedback::where('user_id',Auth::user()->id)->paginate(10);
            }

        }

        if (\Request::ajax()) {

            return view('feedback.ajax',  compact('models'));
        }


        return view('feedback.index', compact('models', 'formModel','usertype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //


        $this->validate($request, Feedback::getValidationRules());

        $input = $request->all();
        $input['user_id'] = Auth::id();
	    Feedback::create($input);

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

        $model = Feedback::findOrFail($id);

      	return view('feedback.show', array('model' => $model));
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
         $model = Feedback::findOrFail($id);

    return view('feedback.edit')->withModel($model);
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
       $model = Feedback::findOrFail($id);

	    $this->validate($request, Feedback::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Feedback successfully updated!');

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
        $model = Feedback::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Feedback successfully deleted!');

	    return redirect('Feedback');
    }
}

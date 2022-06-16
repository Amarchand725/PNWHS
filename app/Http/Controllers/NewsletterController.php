<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Users;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new Newsletter;
        $formModel->fill(Input::get());
        $user = Users::where('id', Auth::user()->id)->first();
        $usertype = $user->userType->name;

        if(isset($_GET['submit'])){
            $models = Newsletter::Search();
        }else{
           $models =  Newsletter::where('is_active',1)->whereDate('expiry_date', '>=', date('Y-m-d'))->paginate(10);
        }


        if (\Request::ajax()) {

            return view('newsletter.ajax',  compact('models'));
        }


        return view('newsletter.index', compact('models', 'formModel','usertype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $user = Users::where('id', Auth::user()->id)->first();
        $usertype = $user->userType->name;
        return view('newsletter.create',compact('usertype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //


        $this->validate($request, Newsletter::getValidationRules());

        $input = $request->all();
        $input['user_id'] = Auth::id();
        if ($request->hasFile('newsletterfile')) {
            $newsletterfiledata = $request->file('newsletterfile');
            if(!empty($newsletterfiledata)){
             $imagestring = str_replace(' ', '', $newsletterfiledata->getClientOriginalName());
            $attachfileName = time().$imagestring;
            $destinationPath = public_path('attachments');
            if($newsletterfiledata->move($destinationPath, $attachfileName)){
                        // $temp[] = $fileName;
            }
            $input['newsletterfile'] =  $attachfileName;
            }else{
                $input['newsletterfile'] = '';
            }
        }


	    Newsletter::create($input);

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

        $model = Newsletter::findOrFail($id);
      	return view('newsletter.show', array('model' => $model));
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
         $model = Newsletter::findOrFail($id);

    return view('newsletter.edit')->withModel($model);
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
       $model = Newsletter::findOrFail($id);

	    $this->validate($request, Newsletter::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'Newsletter successfully updated!');

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
        $model = Newsletter::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Newsletter successfully deleted!');

	    return redirect('Newsletter');
    }
}

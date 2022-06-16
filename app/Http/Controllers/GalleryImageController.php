<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GalleryImage;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formModel = new GalleryImage;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = GalleryImage::Search();
        }else{
           $models =  GalleryImage::paginate(10);
        }
        
                
        if (\Request::ajax()) {

            return view('galleryImage.ajax',  compact('models'));
        }

    	
        return view('galleryImage.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('galleryImage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, GalleryImage::getValidationRules());
        $images=array();
        if(!empty($request->images)){
            if($files=$request->file('images')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('gallery',$name);
                    
                    GalleryImage::create([
                        'created_by' => Auth::user()->id,
                        'name' => $name,
                        'status' => $request->status,
                    ]);
                }
            }

            Session::flash('flash_message', 'Task successfully added!');
        }

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
       
        $model = GalleryImage::findOrFail($id);
       
      	return view('galleryImage.show', array('model' => $model));
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
         $model = GalleryImage::findOrFail($id);

    return view('galleryImage.edit')->withModel($model);
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
       $model = GalleryImage::findOrFail($id);

	    $this->validate($request, GalleryImage::getValidationRules());

	    $model->fill( $request->all() )->save();

	    Session::flash('flash_message', 'GalleryImage successfully updated!');

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
        $model = GalleryImage::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'GalleryImage successfully deleted!');

	    return redirect()->route('galleryImage.index');
    }
}

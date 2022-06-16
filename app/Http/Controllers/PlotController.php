<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plot;
use App\Size;
use Session;
use Illuminate\Support\Facades\Input;
use DB;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $formModel = new Plot;
        $formModel->fill(Input::get());

        if(isset($_GET['submit'])){
            $models = Plot::Search();
        }else{
           $models =  Plot::orderby('id', 'DESC')->paginate(10);
        }
        
        if (\Request::ajax()) {

            return view('plot.ajax',  compact('models'));
        }

    	
        return view('plot.index', compact('models', 'formModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('plot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Plot::getValidationRules());
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if(isset ($file) && count($file) > 0){
                foreach ($file as $key => $image) {
                    $imagestring = str_replace(' ', '', $image->getClientOriginalName());
                    $fileName = time().$imagestring;
                    $destinationPath = public_path('attachment');
                    if($image->move($destinationPath, $fileName)){
                        $temp[] = $fileName;
                    }
                }
                 $input['image'] = json_encode($temp);
            }else{
                $input['image'] = null ;
            }
        }

	    Plot::create($input);

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
       
        $model = Plot::findOrFail($id);
       
      	return view('plot.show', array('model' => $model));
    }
    public function plotget(){
        $slectedval = $_POST['selected_value'];
       $size =  DB::table('size')->where('property_type',$slectedval)->get();
       
        $name ='';
        if (!empty($size)) {
            $name .= "<option value=''>" . 'Select Size' . "</option>";
            foreach ($size as $key) {
                $name .= "<option value='" . $key->id . "'>" . $key->name . "</option>";
            }
        }else{
            $name = "<option value=''> NOT AVILABLE </option>";
        }
        echo $name;
    }
    public function plotgetbytype(){
        $slectedval = $_POST['selected_value'];
       $size =  DB::table('plots')->where('type',$slectedval)->where('plot_status','available')->get();
       
        $typename ='';
        if (!empty($size)) {
            $typename .= "<option value=''>" . 'Select Plots' . "</option>";
            foreach ($size as $key) {
                $typename .= "<option value='" . $key->id . "'>" . $key->plot_no . "</option>";
            }
        }else{
            $typename = "<option value=''> NOT AVILABLE </option>";
        }
        echo $typename;
    }
  
    public function checkplotavailable(){
        $size = $_POST['sizes'];
        $plotunique = $_POST['plotunique'];
        $property_type = $_POST['property_type'];
        $size =  DB::table('plots')->where(array('plot_no'=>$plotunique,'type' => $property_type,'size' => $size))->first();
        //$size =  DB::table('plots')->where('plot_no',$plotunique)->where('type',$property_type)->where('size',$size)->get();
        if(!empty($size)){
              echo '1';  
        }
        else{
            echo '0';
        }
    }
    public function sizebytypeplot(){
        $type = $_POST['type'];
        $plot = $_POST['plot'];
        $dataof =  DB::table('plots')->where(array('id'=>$plot,'type' => $type))->get()->toArray();
        $array1 = DB::table('size')->where('id',$dataof[0]->size)->first();
        $dataof[0]->size = $array1->name;
        return $dataof;
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
        $plot_sizes = Size::where('is_active', 1)->get();
        $model = Plot::findOrFail($id);
        return view('plot.edit', compact('plot_sizes'))->withModel($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
       $model = Plot::findOrFail($id);
        $this->validate($request, Plot::getValidationRules());

        $model->fill( $request->all());
        

        if($request->hasFile('image')){
            $files = $request->file('image');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $temp[] = $filename;
                $picture = $filename;
                $destinationPath = public_path('attachment');
                $file->move($destinationPath, $picture);
            }
                $json = json_encode($temp);
                $model->image = $json;  
        }else{
            $model->image = json_encode(array());
        }
        
        
        $model->save();

	    Session::flash('flash_message', 'Plot successfully updated!');

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
        $model = Plot::findOrFail($id);

	    $model->delete();

	    Session::flash('flash_message', 'Plot successfully deleted!');

	    return redirect()->route('plot.index');
    }

     public function imageView($id)
    {
        $model = Plot::findOrFail($id);
        return view('plot.imageView',['model' => $model]);
    }
}

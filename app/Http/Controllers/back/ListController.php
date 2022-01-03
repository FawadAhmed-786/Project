<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ListController extends Controller
{
    public function index(Request $request){

    	if($request->ajax())
        {
            $data = Listing::get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="list_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('position', function($data) {
                        return   $data->position ;
                    })
                    ->addColumn('title', function($data) {
                        return  $data->title ;
                    }) 

                    ->addColumn('image', function($data) {
                        $img = '<a href="'. asset('assets/images/').'/'.$data->image.'" target="_blank"><img src="'.asset('assets/images/').'/'.$data->image.'"     width="70" class="img-thumbnail" /></a>' ;
                        return $img; 
                
                    }) 

                    ->addColumn('itemcode', function($data) {
                    return  $data->itemcode ;
                    }) 

                    ->addColumn('category_name', function($data) {
                    	$cat_name = '<a href='. url('/admin-area/category').'>'.$data->categories->title.'</a>';
                        return $cat_name ;
                    }) 

                    ->addColumn('price', function($data) {
                    return  $data->price ;
                    }) 

                    ->addColumn('add_top_selling', function($data) {
                        if($data->top_selling == "1"){
                            $toplist = '<label class="switch"><input type="checkbox" checked  rel="'.$data->id.'" class="top_status"><span class="slider round"></span></label>';

                            return $toplist;
                        }else{
                            $toplist = '<label class="switch"><input type="checkbox" rel="'.$data->id.'" class="top_status"><span class="slider round"></span></label>';
                            return $toplist;

                        }
                    }) 

                    ->addColumn('created_at', function($data) {
                      $a = Carbon::parse($data->created_at)->diffForHumans();
                      return $a;                   
                    })

                    ->addColumn('updated_at', function($data) {
                      $b = Carbon::parse($data->updated_at)->diffForHumans();
                      return $b;
                   
                    }) 

                    ->addColumn('action', function($data){

                        $button = '&nbsp;<a href="'.url('/admin-area/update-list/').'/'.$data->id.'" class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','position','title','image','itemcode','category_name','price','add_top_selling','created_at','updated_at','action'])
                    ->make(true);
        }
        return view('back.main_page.list');
    }
    public function addupdatelist(Request $request, $id=null){   
        if($id==""){

            $title = "Add List";
            $list= new Listing;
            $listdata = array();
     

        }else{

            $title = "Edit List";
            $listdata = Listing::where('id', $id)->first();
            $listdata = json_decode(json_encode($listdata),true);
            $list= Listing::find($id);

        }
       
        if($request->isMethod('post')){
                
                if(!empty($id)){
                  $lt =Listing::where('id', $id)->first();

                   if( $request['title'] == $lt->title ){

	                    $data=$request->validate([
	                      "image"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:400",
	                      "title"=>"required|regex:/^[a-zA-Z\s]*$/|max:25|min:5", 
	                      "category_id"=>"required",
	                      "price"=>"required|regex:/^[0-9]+$/|max:4|min:2",
	                    ]);
                 
                   }else{
	                    $data=$request->validate([
	                      "image"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:400",
	                      "title"=>"required|regex:/^[a-zA-Z\s]*$/|max:25|min:5|unique:listings,title", 
	                      "category_id"=>"required",
	                      "price"=>"required|regex:/^[0-9]+$/|max:4|min:2",
	                    ]);
	                }
                }
                if(!empty($id)){
                    $title = Listing::where(['title'=>$request['title']])->count();
	                if($title > 0 && $lt->title !=  $request['title']){
	                    $message = 'This title is already exists ! please use another title';
	                    return redirect('/admin-area/update-list/'.$id)->with('error', $message);
	                }
                }
                
                if($id==""){
                     $data=$request->validate([
                      "image"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:400",
                      "title"=>"required|regex:/^[a-zA-Z\s]*$/|max:25|min:5|unique:listings,title", 
                      "category_id"=>"required",
                      "price"=>"required|regex:/^[0-9]+$/|max:4|min:2",

                    ]);
                      $cat = Category::where(['id'=>$data['category_id']])->first();
	                if($cat == null){
	                     $message = 'This category is not exists !';
	                     return back()->with('error', $message);}
                    $list->title = $data['title'];
	                $list->category_id = $data['category_id'];
	                $list->price = $data['price'];
                    if($request->hasFile('image')){
                    $img_tmp = $request->file('image');
	                    if($img_tmp->isValid()){
	                        //image path
	                        $extension = $img_tmp->getClientOriginalExtension();
	                        $filename = Str::random(10).'.'.$extension;
			                $img_path = 'assets/images/'.$filename;

	                        //image resize
	                        Image::make($img_tmp)->resize(612,434)->save($img_path); 

	                        $list->image = $filename;
	                    }
                    }
                $position = Listing::orderBy('position', 'desc')->first();
                $p =  (isset($position)) ? '0'.($position->position + 1) : '1';          
                $list->position = $p ; 
                $list->top_selling = '0';               
                }else{
                	 $cat = Category::where(['id'=>$data['category_id']])->first();
	                if($cat == null){
	                     $message = 'This category is not exists !';
	                     return back()->with('error', $message);}
                	$list->title = $data['title'];
	                $list->category_id = $data['category_id'];
	                $list->price = $data['price'];
                	if($request->hasFile('image') == null){

                       	$dataget = Listing::where('id', $id)->first();
                        $list->image = $dataget->image;

                    }else{
                        if($request->hasFile('image')){
                        
		                    $img_tmp = $request->file('image');
		                    if($img_tmp->isValid()){
		                    //image path
		                        File::delete(public_path('assets/images/'.$list->image));
		                        $extension = $img_tmp->getClientOriginalExtension();
		                        $filename = Str::random(10).'.'.$extension;
		                        $img_path = 'assets/images/'.$filename;
		                      
		                        //image resize
		                        Image::make($img_tmp)->resize(612,434)->save($img_path); 
		                        $list->image = $filename;
		        
		                    }
	                    } 
                    } 
                    
                }
               
                $list->save(); 
                $listdatas= Listing::where(['id' => $list->id ])->first();
                if($id==""){
     
                    $message= "Add List Successfully! " .$listdatas->title;

                }else{

                    $message = "Update List Successfully! " .$listdatas->title;
 
                } 
                return redirect('/admin-area/lists')->with('success', $message);
        }
        $categories = Category::get();
        return view('back.main_page.addupdatelist')->with(compact('title','categories','listdata'));
    }
    
    public function updatetoplist(Request $request){  
        $data=$request->only(['special']);
        $list = Listing::find($request->id);
        $list->top_selling = $data['special'];
        $list->save();
        return response()->json(['success' => 'Top List Successfully Update Enabled']);
    }
    public function multipledelete(Request $request, $id){
        
        $list_id = $request->input('id');
        $list = Listing::whereIn('id', $list_id);
        $listimage = Listing::whereIn('id', $list_id)->get();
        
        foreach ($listimage as $listimagedata) {

	        if(file_exists(public_path('assets/images/'.$listimagedata->image))){
	            unlink(public_path('assets/images/'.$listimagedata->image)); 
	        }
        }

        $list->delete();
    
        return response()->json(['success' => 'Seleted Data Successfully Deleted']);
       
    }
     
}

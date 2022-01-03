<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CategoryController extends Controller
{
    public function index(Request $request){

        if($request->ajax())
        {
            $data = Category::get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="category_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('position', function($data) {
                    return   $data->position ;
                    })
                    ->addColumn('title', function($data) {
                      return  $data->title ;
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

                        $button = '&nbsp;<a href="'.url('/admin-area/update-category/').'/'.$data->id.'" class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','position','title','created_at','updated_at','action'])
                    ->make(true);
        }
        return view('back.main_page.category');
    }

    public function addupdatecategory(Request $request, $id=null)
    {
        
        if($id==""){

            $title = "Add Category";
            $category= new Category;
            $categorydata = array();
            $message= "Add Category Successfully!";

        }else{

            $title = "Update Category";
            $categorydata = Category::where('id', $id)->first();
            $categorydata = json_decode(json_encode($categorydata),true);

            $category= Category::find($id);
              
          
            $message= "Update Category Successfully!";
        }
       
        if($request->isMethod('post')){
                if(!empty($id)){
                    $cat =Category::where(['id'=> $id])->first();

              
                    if( $request['title'] == $cat->title){
                         
                        $data=$request->validate([
                        "title" => "required|regex:/^[a-zA-Z\s]*$/|max:50|min:3"         
                        ],[
                           "title.regex"=>"Title allow only alphabets (ex : a-z A-Z)"
                        ]);
                                          
                    }else{
                       $data=$request->validate([
                        "title" => "required|regex:/^[a-zA-Z\s]*$/|max:25|min:3|unique:categories,title"
                    ],[
                           "title.regex"=>"Title allow only alphabets (ex : a-z A-Z)"
                        ]);
                    }
                }
                if(!empty($id)){
                    $title = Category::where(['title'=>$request['title']])->count();
                    if($title > 0 && $cat->title !=  $request['title']){
                        $message = 'This category title is already exists ! please use another category title';
                        return redirect('/admin-area/update-category/'.$id)->with('error', $message);
                    }
                }

                if($id==""){
                     $data=$request->validate([
                        "title" => "required|regex:/^[a-zA-Z\s]*$/|max:25|min:3|unique:categories,title"         
                    ],[
                           "title.regex"=>"Title allow only alphabets (ex : a-z A-Z)"
                        ]);
                    $category->title = $data['title'];

                    $position = Category::orderBy('position', 'desc')->first();
                    $p =  (isset($position)) ? '0'.($position->position + 1) : '1';          
                    $category->position = $p ; 
                }else{
                    $category->title = $data['title'];
              
                }

               
                $category->save();
                $categorydatas= Category::where(['id' => $category->id ])->first();
                if($id==""){

                    $message= "Add Category Successfully! " .$categorydatas->title;

                }else{

                    $message = "Update Category Successfully! " .$categorydatas->title;
 
                } 
                return redirect('/admin-area/categories')->with('success', $message);
        }
        return view('back.main_page.addupdatecategory')->with(compact('title','categorydata'));
    }
    public function multipledelete(Request $request){
        
        $cat_id = $request->input('id');
        $cat = Category::whereIn('id', $cat_id);   
        if($cat->delete())
         return response()->json(['success' => 'Category Seleted Data Deleted Successfully']);   
    }
}

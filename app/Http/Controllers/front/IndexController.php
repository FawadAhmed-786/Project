<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
class IndexController extends Controller
{
    public function index(Request $request){
       $toplist = Listing::where('top_selling' , '1')->take(8)->orderBy('position', 'desc')->get();
       return view('front.main_page.index')->with(compact('toplist'));

    }

    public function about(Request $request){

       return view('front.main_page.about');
       
    }

    public function contact(Request $request){

       return view('front.main_page.contact');
       
    }

    public function menu(Request $request){

       $category = Category::withCount('listings')->orderBy('position', 'desc')->get();
       $toplist = Listing::withCount('categories')->orderBy('position', 'desc')->get();
       return view('front.main_page.menu')->with(compact('toplist','category'));  
    }

    
}

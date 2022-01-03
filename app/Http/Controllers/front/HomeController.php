<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_Meats;
class HomeController extends Controller
{

    public function index(Request $request)
    {
        return view('front.main_page.account');
    }

    public function orderhistory(Request $request)
    {
        $user_id = Auth::user()->id;
        $order = Order::with('order_meats')->where(['user_id'=>$user_id])->orderBy('order_number', 'desc')->paginate(10);
        return view('front.main_page.order-history')->with(compact('order'));
    }
    public function personaldetail(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
           
            if($request->isMethod('post')){

                 if(Auth::user()->email ==  $request['email'] || Auth::user()->phone ==  $request['phone']){

                    $data = $request->validate([
                        "name"=>"required|regex:/^[a-zA-Z\s]*$/|max:30|min:3", 
                        "email"=>"required|email|max:50|min:8", 
                        "phone"=>"nullable|regex:/^(\+)([92]{2})(\d{10})$/",
                        "city"=>"nullable|regex:/^[a-zA-Z]*$/|max:10|min:6", 
                        "address"=>"nullable|regex:/^[a-zA-Z1-9\s!#.]*$/|max:50|min:10",
                     
                    ],[
                        "email.email"=>"Please enter a valid email address (Ex: Yourname@domain.com).",
                        "phone.regex"=>"The phone format is invalid (Ex: +921231231231).",
                        "address.regex"=>"The address format is invalid (a-z A-Z 1-9 ! # .)",
                    ]);
                 
                 }
                 else{
                    $data = $request->validate([
                        "name"=>"required|regex:/^[a-zA-Z\s]*$/|max:20|min:3",
                        "email"=>"required|email|max:30|min:8|unique:users,email", 
                        "phone"=>"nullable|regex:/^(\+)([92]{2})(\d{10})$/|unique:users,phone",
                        "city"=>"nullable|regex:/^[a-zA-Z]*$/|max:10|min:6", 
                        "address"=>"nullable|regex:/^[a-zA-Z1-9\s!#.]*$/|max:50|min:10",

              
                    ],[
                        "email.email"=>"Please enter a valid email address (Ex: Yourname@domain.com).",
                        "phone.regex"=>"The phone format is invalid (Ex: +921231231231).",
                         "address.regex"=>"The address format is invalid (a-z A-Z 1-9 ! # .)",
                    ]);
                     
                 }
                   
                
                  $email = User::where(['email'=>$data['email']])->count();
                  if($email>0 && Auth::user()->email !=  $request['email']){
                        $message = 'This email is already exists ! please use another email !';
                           return redirect('/user-area/personal-detail')->with('error', $message);
                  }
                  $phone = User::where(['phone'=>$data['phone']])->count();
                  if($phone>0 && Auth::user()->phone !=  $request['phone']){
                     $message = 'This phone number is already exists ! please use another phone number !';
                           return redirect('/user-area/personal-detail')->with('error', $message);
                  }
                
                  
             

                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->city = $data['city'];
                $user->address = $data['address'];
                $user->save(); 
                $message= "Personal Detail Successfully Save!";
                return redirect('/user-area/personal-detail')->with('success', $message);
            }
        }else{

           return redirect()->back();
        }

        return view('front.main_page.personal-detail');
    }
     public function changepassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->validate([
                'current-password'=>['required', 'string', 'min:8', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
                'password_confirmation' => ['required'],

                
            ]);

             if(Hash::check($data['current-password'],Auth::user()->password)){
                
                  User::where('id',Auth::user()->id)->update(['password'=>Hash::make($data['password'])]);
                $message= "Password Successfully Change!";
                return redirect('/user-area/change-password')->with('success', $message);
             }else{
                $message= "Your current password not match!";
                return redirect('/user-area/change-password')->with('error', $message);
             }
        }
        return view('front.main_page.change-password');
    }

}

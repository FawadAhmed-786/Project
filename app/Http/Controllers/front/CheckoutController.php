<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Validator;
use Illuminate\Support\Str;
use Session;
use App\Models\Order_Meats;
class CheckoutController extends Controller
{
    public function index(Request $request){
    	    $session_id = Session::get('session_id');
        	$subtotalcartamount = Cart::where(['session_id'=>$session_id])->sum('meat_amount');
            $count = Cart::where(['session_id'=>$session_id])->count();
            
            if(	$subtotalcartamount >= 200){
                if(Auth::user()){
	                $user = User::find(Auth::user()->id);
	                $user = json_decode(json_encode($user),true);
	                Cart::where(['session_id'=>$session_id])->update(['user_email'=>Auth::user()->email]); 
			        if(empty($session_id)){
			       		$sum = 0;
			       		$grandsum =  50;
			       		$quantity = 0;
			       		$count = 0;
			        }else if(!empty($session_id)){
			  
                        $count = Cart::where(['session_id'=>$session_id])->get()->count();
			       		$sum = Cart::where(['session_id'=>$session_id])->sum('meat_amount');
			       		$grandsum = $sum + 50;
			       		$quantity = Cart::where(['session_id'=>$session_id])->sum('meat_quantity');
			        }
			        $data = Cart::where(['session_id'=>$session_id])->orderBy('created_at', 'desc')->get();
 
	                return view('front.main_page.checkout')->with(compact('user','data','sum','count','grandsum','quantity'));       
                }
            }else if($count < 1){
			    return redirect('/menu')->with('error','Cart is empty! Unable to checkout.');
            }
            else{
			    return redirect('/menu')->with('error','Minmam Order Atleast Rs.200 Check Cart');	
            }	
    }

     public function orderplace(Request $request){
        $session_id = Session::get('session_id');
        $subtotalcartamount = Cart::where(['session_id'=>$session_id])->sum('meat_amount');
        $count = Cart::where(['session_id'=>$session_id])->get()->count();
        if( $subtotalcartamount >= 200){
            if($request->isMethod('post')){
                if(Auth::user()->email ==  $request['email'] || Auth::user()->phone ==  $request['phone'] ){
                         $data = $request->validate([
                        "name"=>"required|regex:/^[a-zA-Z\s]*$/|max:20|min:3",
                        "email"=>"required|email|max:50|min:8", 
                        "phone"=>"required|regex:/^(\+)([92]{2})(\d{10})$/",
                        "address"=>"required|regex:/([A-Za-z0-9\s])+/|max:100|min:15",
                        "requirement"=>"nullable|regex:/([A-Za-z0-9 ])+/|max:500|min:5"
                    ],[
                        "email.email"=>"Please enter a valid email address (Ex: Yourname@domain.com).",
                        "phone.regex"=>"The phone format is invalid (Ex: +921231231231).",
                    ]);
                
                   
                }else{
                    $data = $request->validate([
                        "name"=>"required|regex:/^[a-zA-Z\s]*$/|max:20|min:3",
                        "email"=>"required|email|max:30|min:8|unique:users,email", 
                        "phone"=>"required|regex:/^(\+)([92]{2})(\d{10})$/|unique:users,phone",
                        "address"=>"required|regex:/([A-Za-z0-9\s])+/|max:100|min:15",
                        "requirement"=>"nullable|regex:/([A-Za-z0-9 ])+/|max:500|min:5"
                    ],[
                        "email.email"=>"Please enter a valid email address (Ex: Yourname@domain.com).",
                        "phone.regex"=>"The phone format is invalid (Ex: +921231231231).",
                    ]);   
                }

                 $email = User::where(['email'=>$data['email']])->count();
                  if($email>0 && Auth::user()->email !=  $request['email']){
                        $message = 'This email is already exists ! please use another email !';
                           return redirect('/checkout')->with('error', $message);
                  }
                  $phone = User::where(['phone'=>$data['phone']])->count();
                  if($phone>0 && Auth::user()->phone !=  $request['phone']){
                     $message = 'This phone number is already exists ! please use another phone number !';
                           return redirect('/checkout')->with('error', $message);
                  }

                $order_number = Order::orderBy('order_number', 'desc')->first();
                $order= new Order;
                $ordernum = (isset($order_number)) ? '0'.($order_number->order_number + 1) : '1';
          		$order->order_number  = $ordernum;
                $qty = Cart::where(['session_id'=>$session_id])->sum('meat_quantity');
                $order->user_id = Auth::user()->id;        
                $order->name = $data['name'];
                $order->email = $data['email'];   
                $order->phone = $data['phone'];
                $order->country = Auth::user()->country;
                $order->city = "Karachi";
                $order->address = $data['address'];       
                $order->order_status = "Pending";
                $order->order_meat_items = $count;
                $order->order_meat_total_qty = $qty;
                $order->sub_amount = $subtotalcartamount;
                $order->delivery_charges =  '50';
        		$order->payable_amount = $subtotalcartamount + '50';
                $order->payment_method = 'COD';
                $req =  $data['requirement'] == null ? "Null" : $data['requirement'];
                $order->order_requirement = $req;  
                $order->save();
                   
                $cartgetdetail = Cart::where(['session_id'=>$session_id,'user_email'=>Auth::user()->email])->get();
                   
                foreach($cartgetdetail as $cartpro ){
                    $order_meat_detail = new Order_Meats;
    	            $order_meat_detail->order_id = $order->id;
    	               
    	            $order_meat_detail->user_id = Auth::user()->id;
    	               
    	            $order_meat_detail->meat_id = $cartpro->id;
    	            $order_meat_detail->meat_title = $cartpro->title;
    	            $order_meat_detail->meat_itemcode = $cartpro->meat_sku;
                    $order_meat_detail->meat_qty = $cartpro->meat_quantity;
                    $order_meat_detail->meat_rate = $cartpro->meat_rate;
                    $order_meat_detail->meat_amount = $cartpro->meat_rate * $cartpro->meat_quantity;
    	            $order_meat_detail->save();
                }
                   
                Session::put('order_number',$order->order_number);
                Session::put('payable_amount',$order->payable_amount);
                $message= "Your Order Successfully Place !";                   
                User::Where(['id'=>Auth::user()->id])->update(['name'=>$data['name'],'email'=>$data['email'],'phone'=>$data['phone'],'city'=>"Karachi",'address'=>$data['address']]);
                Cart::where(['session_id'=>$session_id,'user_email'=>Auth::user()->email])->delete();
                return redirect('/user-area/order-history')->with('success', $message);       
            }   	
        }else if($count < 1){   
          return redirect('/menu')->with('error','Cart is empty! Unable to checkout.');
        }else{  
          return redirect('menu')->with('error','Minimam Order Rs.200'); 
        }
    	
    }
}

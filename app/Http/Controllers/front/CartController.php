<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Listing;
use App\Models\Cart;
use Validator;
use Illuminate\Support\Str;
use Session;
class CartController extends Controller
{
    public function getprice(Request $request){
        $data=$request->only(['size','id']);
        if($data['size'] == "1 kg" || $data['size'] == "half kg" || $data['size'] == 'pao'){
            $list = Listing::where(['id' => $data['id']])->first();
            if($list == null){
            	$message = 'Price is not existing !';
	            return back()->with('error', $message);
            }else{
            	if($data['size'] == "1 kg"){
            		return response()->json(['price'=>$list->price ]);
            	}else if($data['size'] == "half kg"){
            		$price = $list->price / 2;
            		return response()->json(['price'=>$price ]);
            	}else if($data['size'] == "pao"){
            		$price = $list->price / 4;
            		return response()->json(['price'=>$price ]);
            	}
            } 
        }else{
        	$message = 'Please correct the unit !';
	        return back()->with('error', $message);
        }
        
    }

    public function store(Request $request){
    	$data = Validator::make($request->only(['unit','quantity','id']),[
           'unit'=> 'required|regex:/^[0-9a-z\s]+$/|max:7|min:3',
           'quantity'=> 'required|regex:/^[0-9]+$/|max:2|min:1'
        ]);

        if($data->fails())
        {
            return response()->json(['errors' => $data->errors()->all()]);

        }else{
           
            $listdata = Listing::where(['id'=>$request['id']])->first();
            if($listdata == null){
                return response()->json(['errorcount' => 'Please refresh the page !']);
            }else{
                if($request->isMethod('post')){ 

	                $data=$request->only(['unit','quantity']);
	                $session_id = Session::get('session_id');
		            if(empty($session_id)){
		            	$session_id = Str::random(40);
		                Session::put('session_id',$session_id);
		            } 
                    if($data['unit'] != "1 kg" && $data['unit'] != "half kg" && $data['unit'] != "pao"){
                    	return response()->json(['errorcount' => 'Please refresh the page !']);
                    }
		            	$cartcount= Cart::where(['meat_sku'=>$listdata->itemcode,'meat_pick_unit'=> $data['unit'],'title'=>$listdata->title,'session_id'=>$session_id])->count();
		                if($cartcount>0){
		                    return response()->json(['errorcount' => 'Meat already add in Cart. Increase quantity in the cart']);
		                }else{
		                	if($data['unit'] == "1 kg"){
			            		$price =  $listdata->price / 1;
			            		$amount = $price * $data['quantity'];
			            	}else if($data['unit'] == "half kg"){
			            		$price =  $listdata->price / 2;
			            		$amount = $price * $data['quantity'];
			            	
			            	}else if($data['unit'] == "pao"){
			            		$price =  $listdata->price / 4;
			            		$amount = $price * $data['quantity'];
			            		
			            	}
			            	
		                    $cart= new Cart;
		                    $cart->meat_id = $listdata->id;
				            $cart->title = $listdata->title;
				            $cart->meat_sku = $listdata->itemcode;
				            $cart->meat_quantity = $data['quantity'];
				            $cart->meat_pick_unit = $data['unit'];
				            $cart->meat_rate = $price ;
				            $cart->meat_amount = $amount;
				            $cart->user_email = null;
				            $cart->user_phone = null ;
				            $cart->session_id = $session_id;             
			                $cart->save(); 
			                return response()->json(['success' => 'Meat in Cart Successfully Add ' . $cart->title . ' ' . $cart->meat_pick_unit]);
		                }
		           
	            }

		            
	            
            }
           
        }
    }

    public function count(Request $request){

    	if($request->ajax()) {
	        $session_id = Session::get('session_id');
	        $count = Cart::where(['session_id'=>$session_id])->get()->count();
	        echo $count;
        }
      
    }
    public function cart(Request $request){
    	$session_id = Session::get('session_id');
        	if(empty($session_id)){
        		$sum = 0;
        		$grandsum =  50;
        		$quantity = 0;
        	}else if(!empty($session_id)){
        	
        		$sum = Cart::where(['session_id'=>$session_id])->sum('meat_amount');
        		$grandsum = $sum + 50;
        		$quantity = Cart::where(['session_id'=>$session_id])->sum('meat_quantity');
        	}
        $data = Cart::where(['session_id'=>$session_id])->orderBy('created_at', 'desc')->get();
        return view('front.main_page.cart')->with(compact('data','sum','grandsum','quantity'));   
    }
     public function cartmeatdelete(Request $request, $id=null){
       
	        $session_id = Session::get('session_id');
	        $cart = Cart::where(['session_id'=>$session_id, 'id'=> $id]);
	        $cartdata = Cart::where(['session_id'=>$session_id, 'id'=> $id])->first();
	        if($cart->delete())
	            return back()->with('success', $cartdata->title . ' delete in the cart');
        
        
    }

    public function cartmeatupdateplus(Request $request, $id=null){
    	
        $session_id = Session::get('session_id');
        $cart = Cart::where(['session_id'=>$session_id, 'id'=> $id])->increment('meat_quantity',+1);
        $cartdata = Cart::where(['session_id'=>$session_id, 'id'=> $id])->first();
        if($cartdata->meat_quantity > 20){
        	$cartqty = Cart::where(['session_id'=>$session_id, 'id'=> $id])->increment('meat_quantity',-1);
    		
    		return back()->with('error', $cartdata->title . ' Quantity Maximam 20');
    		
    	}
        $newamount = $cartdata->meat_rate * $cartdata->meat_quantity;
        $cartamount = Cart::where(['session_id'=>$session_id, 'id'=> $id])->update(['meat_amount'=>$newamount]);
    	return back()->with('success', $cartdata->title . ' Quantity Update');
     
    	
       
    }
     public function cartmeatupdateminus(Request $request, $id=null){
    	
        $session_id = Session::get('session_id');
        $cart = Cart::where(['session_id'=>$session_id, 'id'=> $id])->increment('meat_quantity',-1);
        $cartdata = Cart::where(['session_id'=>$session_id, 'id'=> $id])->first();
       
        $newamount = $cartdata->meat_rate * $cartdata->meat_quantity;
        $cartamount = Cart::where(['session_id'=>$session_id, 'id'=> $id])->update(['meat_amount'=>$newamount]);
        if($cartdata->meat_quantity<=0){
           $cart = Cart::where(['session_id'=>$session_id, 'id'=> $id])->delete();
        }
        return back()->with('success', $cartdata->title . ' Quantity Update');
     
    	
       
    }
}

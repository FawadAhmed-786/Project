<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order_Meats;
use Validator;
class OrderController extends Controller
{
    public function index(Request $request){

    	if($request->ajax())
        {
           $data = Order::with('order_meats')->orderBy('order_number', 'desc')->get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="order_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('oorder_number', function($data) {
                    return   $data->order_number ;
                    })
                    ->addColumn('oname', function($data) {
                    return  $data->name ;
                    })
                    ->addColumn('ophone', function($data) {
                    return $phone = '<a href="tel:'.$data->phone.'">'.$data->phone.'</a>'; 
                    })
                    ->addColumn('oorder_status', function($data) {
                        if ($data->order_status == 'Pending') {
                           $d = '<p style="color:red;font-weight: 600;">' . $data->order_status . '</p>';
                            return $d;
                        }
                        else if($data->order_status == "OnTheWay"){
                           $d = '<p style="color:#0089ff;font-weight: 600;">On The Way</p>';
                            return $d;
                        }
                        else if($data->order_status == "Paid"){
                           $d = '<p style="color:#00ff2b;font-weight: 600;">' . $data->order_status . '</p>';
                            return $d;
                        }
                        else if($data->order_status == "OrderCancel"){
                           $d = '<p style="color:red;font-weight: 600;">Order Cancel</p>';
                            return $d;
                        }
                        
                 
                    })
                    ->addColumn('oorder_meat_items', function($data) {
                    return  $data->order_meat_items ;
                    })
                    ->addColumn('oorder_meat_total_qty', function($data) {
                    return $data->order_meat_total_qty ;
                    })
                     ->addColumn('osub_amount', function($data) {
                    return   $data->sub_amount ;
                    })
                      ->addColumn('odelivery_charges', function($data) {
                    return $data->delivery_charges ;
                    })
                     ->addColumn('opayable_amount', function($data) {
                    return   $data->payable_amount ;
                    })

                    ->addColumn('odate', function($data) {
                    	$a = Carbon::parse($data->created_at)->isoFormat('ddd DD-M-Y') ;
                    return $a;
                    })
                     ->addColumn('otime', function($data) {
                     	$b = Carbon::parse($data->created_at)->isoFormat('H:mm:ss') ;
                    return $b;
                    })

                    
                    
                    ->addColumn('action', function($data){

                        $button = '<a href="'.url('/admin-area/view-order-detail/').'/'.$data->id.'" class="m-5-r view-order-detail btn btn-add btn-sm" id="'.$data->id.'"  target="_blank"><i class="fa fa-eye"></i></a>';
                       
                        return $button;
                    }) 

                    ->rawColumns(['checkbox','oorder_number','oname','ophone','oorder_status','oorder_meat_items','oorder_meat_total_qty','osub_amount','odelivery_charges','opayable_amount','odate','otime','action'])
                    ->make(true);
        
      }
      

        return view('back.main_page.order');
    }

    public function orderdetail(Request $request,  $id=null){
    
        $order = Order::with('order_meats')->where(['id'=>$id])->first();
        $ordersdetail = Order::with('order_meats')->where(['id'=>$id])->get();
       
        return view('back.main_page.order-detail')->with(compact('order','ordersdetail'));
    }

    public function orderstatuschange(Request $request){
    	if($request->ajax())
        {
	    	$data = Validator::make($request->only(['info','id']),[
	           'info'=> 'required|regex:/^[A-Za-z]+$/|max:11|min:4',
	        ]);

	        if($data->fails())
	        {
	            return response()->json(['errors' => $data->errors()->all()]);

	        }else{
	            $data=$request->only(['info','id']);
	            $orderstatus = Order::where(['id'=>$data['id']])->first();
	            if($orderstatus == null){
	                return response()->json(['errorcount' => 'Please refresh the page !']);
	            }else{
	                if($request->isMethod('post')){ 
	                    if($data['info'] != "Pending" && $data['info'] != "OnTheWay" && $data['info'] != "OrderCancel" && $data['info'] != "Paid" ){
	                    	return response()->json(['errorcount' => 'Please refresh the page !']);
	                    }	
                        $orderstatus->order_status = $data['info'];           
				        $orderstatus->save(); 
				        return response()->json(['success' => 'Order Status Successfully Update ' . $orderstatus->order_status]);
  
		            }       
	            }
	           
	        }
        }
    }
}

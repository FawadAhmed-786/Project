<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class CustomerController extends Controller
{
   
    public function index(Request $request){

        if($request->ajax())
        {

            $data = User::get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                    	if(Gate::denies('isCurrentUser', $data)){
                        $checkbox =  '<input type="checkbox" name="customer_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                        }
                       
                    }) 
                    ->addColumn('position', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
		                    return   $data->position ;
		                }
                    })
                    ->addColumn('name', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                          return  $data->name ;
                        }

                    }) 
                    ->addColumn('email', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                          return  $data->email ;
                        }
                    }) 
                    ->addColumn('role', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
	                     	$showdata = array();
	                     	foreach ($data->roles as $key => $value) {
	                     		$showdata[] = $value->role;
	                     	}
	                        return  $showdata;
                        }
                    })
                    ->addColumn('phone', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                          return  $data->phone ;
                        }
                    }) 
                    ->addColumn('country', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                          return  $data->country ;
                        }
                    }) 
                    ->addColumn('city', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                         return  $data->city ;
                        }
                    }) 
                    ->addColumn('address', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
                          return  $data->address ;
                        }
                    }) 
                    ->addColumn('created_at', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
	                      $a = Carbon::parse($data->created_at)->diffForHumans();
	                      return $a; 
	                    }                  
                    })
                    ->addColumn('updated_at', function($data) {
                    	if(Gate::denies('isCurrentUser', $data)){
	                      $b = Carbon::parse($data->updated_at)->diffForHumans();
	                      return $b;
	                    } 
                   
                    })                                                          
                    ->rawColumns(['checkbox','position','name','email','role','phone','country','city','address','created_at','updated_at'])
                    ->make(true);
                
        }
        return view('back.main_page.customer');
    }
    public function multipledelete(Request $request){
        $data = $request->input('id');
		if(Gate::denies('isCurrentAdmin', $data)){
		    $user_id = $request->input('id');
		    $user = User::whereIn('id', $user_id);   
		    if($user->delete())
		        return response()->json(['success' => 'Customer Seleted Data Deleted Successfully']); 

	    }else{
	        	return redirect('/admin-area/customers')->with('error', 'Not allow to exists');
	    }                 		
	    
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use Session;
class Checkoutguaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

        $session_id = Session::get('session_id');
        $cart = Cart::where(['session_id'=>$session_id])->count();
        if($cart < 1 ){
            return  redirect('/menu')->with('error','Cart is Empty Please Select Meat'); 
        }
      


        return $next($request);
    }
}

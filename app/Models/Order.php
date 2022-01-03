<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Meats;
class Order extends Model
{
    use HasFactory;
    use \App\Http\Traits\UsesUuid;

    protected $table = 'orders';
    protected $fillable = [
        'order_number','user_id','name','email','phone','country','city','address','order_status','order_meat_items','order_meat_total_qty','sub_amount','delivery_charges','payable_amount','payment_method',
    ];
     public function order_meats()
    {
        return $this->hasMany(Order_Meats::class, 'order_id');
    }
   
}

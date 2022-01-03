<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\Order;
class Order_Meats extends Model
{
    use HasFactory;
     use \App\Http\Traits\UsesUuid;

    protected $table = 'order_meats';
    protected $fillable = [
        'order_id','user_id','meat_id','meat_title','meat_itemcode','meat_rate','meat_qty','meat_amounts',

    ];

    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}

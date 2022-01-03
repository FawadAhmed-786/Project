<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use \App\Http\Traits\UsesUuid;

    protected $table = 'carts';
    protected $fillable = [
        'meat_id','title','meat_sku','meat_quantity','meat_rate','meat_amount','user_email','user_phone','session_id',
    ];
}

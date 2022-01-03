<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use BinaryCats\Sku\HasSku;
class Listing extends Model
{
    use HasFactory , HasSku;
    use \App\Http\Traits\UsesUuid;

    protected $table = 'listings';

    protected $fillable = [
        'image','title','position','itemcode','category_id','price','top_selling'
    ];
    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}

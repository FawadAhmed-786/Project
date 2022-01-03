<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
class Category extends Model
{
    use HasFactory;
    use \App\Http\Traits\UsesUuid;

    protected $table = 'categories';

    protected $fillable = [
        'title','position'
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class, 'category_id');
    }
}

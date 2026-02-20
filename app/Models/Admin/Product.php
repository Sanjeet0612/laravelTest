<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Admin\ProductImage;


class Product extends Model
{
    use SoftDeletes;

    protected $table = 'tb_products';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'status',
    ];

   
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

   
}
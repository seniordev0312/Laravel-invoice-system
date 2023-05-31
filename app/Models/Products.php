<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'sc_shop_product';

    protected $fillable = [
        'sku',
        'upc',
        'price',
        'cost',
        'stock',
        'status',        
    ];
}

?>

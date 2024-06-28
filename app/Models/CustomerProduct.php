<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'receipt_no',
        'customer_name',
        'customer_phonenumber',
        'product_name',
        'price',
        'quantity',
        'item_total',
        'overall_total',
    ];
    public static function boot()
    {
        
        parent::boot();

        static::creating(function($product){
            $product->receipt_no=static::generateOrderNumber();
        });
    }

    public static function generateOrderNumber()
    {
        return 'RCP'.date('ymd').mt_rand(1000,9999);
    }
}

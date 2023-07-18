<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'product_id',
        'amount',
        'type',
        'uses',
        'max_uses',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'uses' => 'integer',
        'max_uses' => 'integer',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

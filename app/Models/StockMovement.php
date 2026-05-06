<?php

namespace App\Models;

use App\Observers\StockMovementObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(StockMovementObserver::class)]
class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'qty',
        'price',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

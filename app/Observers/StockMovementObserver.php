<?php

namespace App\Observers;

use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class StockMovementObserver
{
    public function created(StockMovement $movement): void
    {
        DB::transaction(function () use ($movement) {
            
            $product = $movement->product;
            if ($movement->type === 'in') {
                $total_aset_lama = $product->stock * $product->hpp;
                $total_aset_baru = $movement->qty * $movement->price;
                $stok_baru = $product->stock + $movement->qty;
                $hpp_baru = ($total_aset_lama + $total_aset_baru) / $stok_baru;
                $product->update([
                    'stock' => $stok_baru,
                    'hpp' => $hpp_baru,
                ]);
            } 
            elseif ($movement->type === 'out') {
                $stok_baru = $product->stock - $movement->qty;
                if ($stok_baru < 0) {
                    throw new \Exception("Stok tidak mencukupi untuk dikeluarkan!");
                }   
                $product->update([
                    'stock' => $stok_baru,
                ]);
            }
        });
    }
}
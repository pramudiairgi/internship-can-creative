<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // Mengatur widget agar selalu berada di urutan paling atas halaman
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Kalkulasi Total Nilai Aset (Stok x HPP)
        // Menggunakan teknik Collection sum agar lebih mudah dibaca
        $totalAset = Product::all()->sum(function ($product) {
            return $product->stock * $product->hpp;
        });

        return [
            // Kotak 1: Menghitung jumlah jenis barang (SKU)
            Stat::make('Total Jenis Produk', Product::count())
                ->description('Jumlah SKU aktif di gudang')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),

            // Kotak 2: Menghitung total keseluruhan unit barang
            Stat::make('Total Stok Fisik', Product::sum('stock'))
                ->description('Total unit barang tersedia')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),

            // Kotak 3: Menghitung total uang yang menjadi aset gudang
            Stat::make('Total Nilai Aset', 'Rp ' . number_format($totalAset, 0, ',', '.'))
                ->description('Akumulasi Stok dikali HPP')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
        ];
    }
}
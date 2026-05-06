<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;


class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                ->relationship('product', 'name')
                ->label('Pilih Barang')
                ->searchable()
                ->columnSpanFull(),

                Select::make('type')
                ->options([
                    'in' => 'Restock (Barang Masuk)',
                    'out' => 'Distribusi (Barang Keluar)',
                ])
                ->default('in')
                ->label('Jenis Transaksi')
                ->required(),

                TextInput::make('qty')
                ->numeric()
                ->label('Jumlah (QTY)')
                ->minValue(1)
                ->required(),

                TextInput::make('price')
                ->numeric()
                ->prefix('Rp')
                ->label('Harga Satuan')
                ->required(),
            ]);


    }
}

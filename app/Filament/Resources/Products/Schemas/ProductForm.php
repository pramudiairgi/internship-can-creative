<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Nama Barang')
                ->required()
                ->MaxLength(255),

                TextInput::make('stock')
                ->label('Stock Saat Ini')
                ->numeric()
                ->default(0)
                ->disabled()
                ->dehydrated(false),

                TextInput::make('hpp')
                ->label('Harga Pokok Penjualan (HPP)')
                ->numeric()
                ->prefix('RP')
                ->default(0)
                ->disabled()
                ->dehydrated(false),
            ]);
    }
}

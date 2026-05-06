<?php

namespace App\Filament\Resources\StockMovements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                ->label('Nama Barang')
                ->searchable(),

                TextColumn::make('type')
                ->label('Jenis Transaksi')
                ->searchable(),

                TextColumn::make('qty')
                ->numeric()
                ->label('Jumlah')
                ->searchable(),

                TextColumn::make('price')
                ->label('Harga')
                ->prefix('Rp')
                ->searchable(),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

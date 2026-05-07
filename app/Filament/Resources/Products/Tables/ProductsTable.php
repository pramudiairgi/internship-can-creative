<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama Barang')
                ->searchable(),

                TextColumn::make('stock')
                ->label('Sisa Stock')
                ->numeric()
                ->sortable(),

                TextColumn::make('hpp')
                ->label('HPP / Unit')
                ->money('IDR')
                ->sortable(),
            ])
            ->filters([
                Filter::make('stock_kritis')
                ->label('Stock Kritis')
                ->query(fn (Builder $query): Builder => $query->where('stock', '<', 5))
                ->indicator('Menampilkan stock kritis'),
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

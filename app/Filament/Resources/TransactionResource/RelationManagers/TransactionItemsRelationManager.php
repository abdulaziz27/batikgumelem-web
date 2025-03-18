<?php

namespace App\Filament\Resources\TransactionResource\RelationManagers;

use App\Models\Product;
use App\Models\ProductSize;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactionItems';

    protected static ?string $recordTitleAttribute = 'product_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('price', Product::find($state)?->price ?? 0);

                        // Reset size when product changes
                        $set('product_size_id', null);
                    }),

                Forms\Components\Select::make('product_size_id')
                    ->label('Size')
                    ->options(function (callable $get) {
                        $productId = $get('product_id');
                        if (!$productId) {
                            return [];
                        }

                        return ProductSize::where('product_id', $productId)
                            ->get()
                            ->pluck('name', 'id');
                    })
                    ->placeholder('Select a size')
                    ->hidden(fn(callable $get) => !$get('product_id')),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->default(1)
                    ->required()
                    ->minValue(1)
                    ->reactive()
                    ->afterStateUpdated(fn($state, $get, callable $set) => $set('total', $state * $get('price'))),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->disabled()
                    ->numeric()
                    ->prefix('IDR'),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->disabled()
                    ->numeric()
                    ->prefix('IDR'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('size_name')
                    ->label('Size')
                    ->default('-'),

                Tables\Columns\ImageColumn::make('product.galleries.first.url')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('quantity'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('total')
                    ->money('IDR')
                    ->getStateUsing(fn($record) => $record->quantity * $record->price),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function ($data, $record) {
                        $transaction = $record->transaction;
                        $transaction->total_price = $transaction->transactionItems->sum(function ($item) {
                            return $item->quantity * $item->price;
                        });
                        $transaction->save();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($data, $record) {
                        $transaction = $record->transaction;
                        $transaction->total_price = $transaction->transactionItems->sum(function ($item) {
                            return $item->quantity * $item->price;
                        });
                        $transaction->save();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($data, $record) {
                        $transaction = $record->transaction;
                        $transaction->total_price = $transaction->transactionItems->sum(function ($item) {
                            return $item->quantity * $item->price;
                        });
                        $transaction->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

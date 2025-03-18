<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SizesRelationManager extends RelationManager
{
    protected static string $relationship = 'sizes';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Size Name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('description')
                    ->label('Size Description')
                    ->maxLength(255)
                    ->placeholder('e.g., Length: 200cm, Width: 110cm'),
                Forms\Components\TextInput::make('stock')
                    ->label('Stock Available')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Size')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(30),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Available Stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function () {
                        // Update the parent product's total stock after creating a new size
                        $product = Product::find($this->ownerRecord->id);
                        $totalStock = $product->sizes()->sum('stock');
                        $product->update(['stock' => $totalStock]);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function () {
                        // Update the parent product's total stock after editing a size
                        $product = Product::find($this->ownerRecord->id);
                        $totalStock = $product->sizes()->sum('stock');
                        $product->update(['stock' => $totalStock]);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function () {
                        // Update the parent product's total stock after deleting a size
                        $product = Product::find($this->ownerRecord->id);
                        $totalStock = $product->sizes()->sum('stock');
                        $product->update(['stock' => $totalStock]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function () {
                            // Update the parent product's total stock after bulk deletion
                            $product = Product::find($this->ownerRecord->id);
                            $totalStock = $product->sizes()->sum('stock');
                            $product->update(['stock' => $totalStock]);
                        }),
                ]),
            ]);
    }
}

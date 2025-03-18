<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\GalleriesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\SizesRelationManager;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Shops';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $state, Forms\Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id')) // Mengambil semua kategori
                    ->searchable(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),

                // Note: We'll leave the main stock field but make it read-only as stock is now managed per size
                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->label('Total Stock (Combined from all sizes)')
                    ->helperText('This field is now calculated from individual size stocks and will be auto-updated')
                    ->disabled()
                    ->dehydrated(false),

                // Product Sizes Section
                Forms\Components\Section::make('Product Sizes')
                    ->description('Define available sizes and their inventory levels')
                    ->schema([
                        Forms\Components\Repeater::make('sizes')
                            ->relationship()
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
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->reorderableWithButtons()
                            ->createItemButtonLabel('Add Size'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Featured Image')
                    ->circular()
                    ->getStateUsing(function (Product $record) {
                        return $record->galleries()
                            ->where('is_featured', true)
                            ->first()
                            ?->url; // null safe operator
                    }),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('sizes_count')
                    ->label('Available Sizes')
                    ->counts('sizes'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Total Stock')
                    ->getStateUsing(fn(Product $record) => $record->getTotalSizeStockAttribute())
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GalleriesRelationManager::class,
            SizesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }

    // Add a method to save sizes and update total stock
    protected static function afterSave(Product $record): void
    {
        // Update the main product stock based on the sum of all size stocks
        $totalStock = $record->sizes()->sum('stock');
        $record->update(['stock' => $totalStock]);
    }
}

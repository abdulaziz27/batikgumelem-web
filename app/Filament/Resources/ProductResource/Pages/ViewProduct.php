<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function beforeFill(): void
    {
        $this->record->load('galleries', 'sizes', 'category');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Product Details')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Product Name')
                        ->disabled(),

                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->prefix('IDR')
                        ->disabled(),

                    Forms\Components\TextInput::make('category.name')
                        ->label('Category')
                        ->disabled(),

                    Forms\Components\TextInput::make('stock')
                        ->label('Total Stock')
                        ->disabled(),

                    Forms\Components\RichEditor::make('description')
                        ->label('Description')
                        ->columnSpanFull()
                        ->disabled(),
                ]),

            Forms\Components\Section::make('Product Images')
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Gallery')
                                ->content(function ($record) {
                                    if ($record->galleries->isEmpty()) {
                                        return 'No images available';
                                    }

                                    $html = '<div class="grid grid-cols-2 md:grid-cols-3 gap-4">';

                                    foreach ($record->galleries as $gallery) {
                                        $imageUrl = asset('storage/' . $gallery->getRawUrl());

                                        $featuredLabel = $gallery->is_featured
                                            ? '<span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Featured</span>'
                                            : '';

                                        $html .= "
                                            <div class='relative rounded-lg overflow-hidden border border-gray-200'>
                                                {$featuredLabel}
                                                <img src='{$imageUrl}' alt='Product image' class='w-full h-48 object-cover'>
                                            </div>
                                        ";
                                    }

                                    $html .= '</div>';

                                    return new \Illuminate\Support\HtmlString($html);
                                })
                                ->columnSpanFull(),
                        ]),
                ]),

            Forms\Components\Section::make('Size Information')
                ->schema([
                    Forms\Components\Repeater::make('sizes')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Size')
                                ->disabled(),
                            Forms\Components\TextInput::make('description')
                                ->disabled(),
                            Forms\Components\TextInput::make('stock')
                                ->label('Stock')
                                ->disabled(),
                        ])
                        ->columns(3)
                        ->disableItemCreation()
                        ->disableItemDeletion()
                        ->disableItemMovement()
                        ->collapsed(),
                ]),
        ];
    }
}

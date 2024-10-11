<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    // Method ini dipanggil sebelum form diisi dengan data record
    protected function beforeFill(): void
    {
        // Eager load relasi galleries
        $this->record->load('galleries');
        // dd($this->record->galleries);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Product Name')
                ->disabled(),

            Forms\Components\TextInput::make('price')
                ->label('Price')
                ->disabled(),

            Forms\Components\RichEditor::make('description')
                ->label('Description')
                ->disabled(),

                Forms\Components\Repeater::make('galleries')
                ->relationship() // Mengambil data dari relasi galleries
                ->schema([
                    Forms\Components\TextInput::make('url') // Tampilkan URL untuk debugging
                        ->label('Image URL')
                        ->disabled(),
                    Forms\Components\Image::make('url')
                        ->label('Image')
                        ->image()
                        ->disableLabel()
                        ->maxWidth(300)
                        ->disabled(),
                ])
                ->columns(1)
                ->disableItemMovement()
                ->disableAddingItems()
                ->disableDeletingItems()
                ->label('Product Gallery'),
        ];
    }
}

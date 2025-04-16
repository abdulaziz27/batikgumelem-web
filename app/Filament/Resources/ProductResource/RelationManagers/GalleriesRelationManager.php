<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GalleriesRelationManager extends RelationManager
{
    protected static string $relationship = 'galleries';

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Temporarily disable accessor when filling the form
        ProductGallery::disableAccessor();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If URL is null or empty during an edit, don't include it in the data
        if (empty($data['url'])) {
            unset($data['url']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // Re-enable accessor after saving
        ProductGallery::enableAccessor();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('url')
                    ->required(fn($livewire) => $livewire instanceof \Filament\Resources\RelationManagers\CreateRecord)
                    ->disk('public')
                    ->directory('product-images')
                    ->image()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->dehydrated(fn($state) => filled($state))
                    ->columnSpanFull()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured Image')
                    ->default(false)
                    ->helperText('Set as the main product image'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('url')
                    ->label('Image')
                    ->circular()
                    ->disk('public'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Override default save behavior to handle URL field
    protected function handleRecordUpdate($record, array $data): mixed
    {
        // Remove url if empty to avoid nulling it out
        if (empty($data['url'])) {
            unset($data['url']);
        }

        return $record->update($data);
    }
}

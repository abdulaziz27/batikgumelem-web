<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Transaction Details')
                    ->schema([
                        TextEntry::make('id')->label('Transaction ID'),
                        TextEntry::make('user.name')->label('Customer'),
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('phone'),
                        TextEntry::make('address')->columnSpanFull(),
                        TextEntry::make('courier'),
                        TextEntry::make('payment'),
                        TextEntry::make('total_price')->money('IDR'),
                        TextEntry::make('status')->badge(),
                        TextEntry::make('created_at')->dateTime(),
                    ])->columns(2),

                Section::make('Transaction Items')
                    ->schema([
                        RepeatableEntry::make('transactionItems')
                            ->schema([
                                TextEntry::make('product.name')->label('Product'),
                                TextEntry::make('size_name')
                                    ->label('Size')
                                    ->default('-'),
                                TextEntry::make('quantity'),
                                TextEntry::make('price')->money('IDR'),
                                TextEntry::make('total')
                                    ->money('IDR')
                                    ->state(function ($record) {
                                        return $record->quantity * $record->price;
                                    }),
                            ])
                            ->columns(5)
                    ])
            ]);
    }
}

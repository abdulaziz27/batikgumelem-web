<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers\TransactionItemsRelationManager;
use App\Filament\Widgets\TransactionStats;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Carbon;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Shops';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(500),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('courier')
                    ->maxLength(255),
                Forms\Components\Select::make('payment')
                    ->options([
                        'Gopay' => 'Gopay',
                        'MIDTRANS' => 'Midtrans',
                        'COD' => 'COD',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                Forms\Components\Select::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PROCESSING' => 'Processing',
                        'SHIPPED' => 'Shipped',
                        'DELIVERED' => 'Delivered',
                        'COMPLETED' => 'Completed',
                        'CANCELLED' => 'Cancelled',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'CANCELLED',
                        'warning' => 'PENDING',
                        'success' => 'COMPLETED',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PROCESSING' => 'Processing',
                        'SHIPPED' => 'Shipped',
                        'DELIVERED' => 'Delivered',
                        'COMPLETED' => 'Completed',
                        'CANCELLED' => 'Cancelled',
                    ]),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('complete')
                    ->action(fn (Transaction $record) => $record->update(['status' => 'COMPLETED']))
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->visible(fn (Transaction $record): bool => $record->status !== 'COMPLETED' && $record->status !== 'CANCELLED'),
                Tables\Actions\Action::make('cancel')
                    ->action(fn (Transaction $record) => $record->update(['status' => 'CANCELLED']))
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->visible(fn (Transaction $record): bool => $record->status !== 'COMPLETED' && $record->status !== 'CANCELLED'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TransactionItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TransactionStats::class,
        ];
    }
}

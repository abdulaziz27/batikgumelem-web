<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionStats extends BaseWidget
{
    protected function getStats(): array
    {
        $transactions = Transaction::query();

        return [
            Stat::make('Total Transactions', $transactions->count())
                ->description('Total number of transactions')
                ->icon('heroicon-o-shopping-cart')
                ->color('primary'),

            Stat::make('Total Revenue', 'IDR ' . number_format($transactions->sum('total_price'), 0, ',', '.'))
                ->description('Total revenue from all transactions')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Average Transaction Value', 'IDR ' . number_format($transactions->avg('total_price'), 2, ',', '.'))
                ->description('Average value per transaction')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}

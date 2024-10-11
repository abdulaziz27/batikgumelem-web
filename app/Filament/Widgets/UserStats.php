<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $newUsersThisMonth = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $activeUsersLastMonth = User::where('last_activity_at', '>=', Carbon::now()->subMonth())->count();
        $averageLoginCount = User::avg('login_count');

        $mostCommonRole = DB::table('model_has_roles')
            ->select('roles.name', DB::raw('count(*) as total'))
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->groupBy('roles.name')
            ->orderByDesc('total')
            ->first();

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('Overall user base')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('New Users This Month', $newUsersThisMonth)
                ->description('User growth')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, $newUsersThisMonth]),
            Stat::make('Active Users (Last 30 Days)', $activeUsersLastMonth)
                ->description(number_format(($activeUsersLastMonth / $totalUsers) * 100, 1) . '% of total')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('info'),
            Stat::make('Avg. Logins per User', number_format($averageLoginCount, 1))
                ->description('User engagement')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
            Stat::make('Most Common Role', $mostCommonRole ? $mostCommonRole->name : 'N/A')
                ->description($mostCommonRole ? "{$mostCommonRole->total} users" : 'No roles assigned')
                ->descriptionIcon('heroicon-m-identification')
                ->color('danger'),
        ];
    }
}

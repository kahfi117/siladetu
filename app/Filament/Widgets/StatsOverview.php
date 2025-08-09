<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        $queryBase = Complaint::query();

        // Jika bukan admin, filter hanya data yang dibuat oleh user tersebut
        if (!$user->hasRole('admin')) {
            $queryBase->where('assigned_to', $user->id);
        }

        $complaintNew = (clone $queryBase)->where('complaint_status', 'new')->count();
        $complaintProcess = (clone $queryBase)->whereNotIn('complaint_status', ['new', 'done'])->count();
        $complaintDone = (clone $queryBase)->where('complaint_status', 'done')->count();

        return [
            Stat::make('Pengaduan Baru', $complaintNew)
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Pengaduan Di Proses', $complaintProcess)
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color(Color::Indigo),
            Stat::make('Pengaduan Selesai', $complaintDone)
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}

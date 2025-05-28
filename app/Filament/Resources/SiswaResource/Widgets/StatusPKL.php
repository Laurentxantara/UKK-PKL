<?php

namespace App\Filament\Resources\SiswaResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Siswa;
use Filament\Support\Enums\IconPosition;

class StatusPKL extends BaseWidget
{
    protected ?string $heading = 'Status PKL Siswa';
    protected function getStats(): array
    {
        $diterima = Siswa::where('status_pkl', 'diterima')->count();
        $kosong = Siswa::where('status_pkl','kosong')->count();

        return [
            Stat::make('Siswa SIJA', $diterima)
                ->description('Diterima')
                ->descriptionIcon('bi-check-circle', IconPosition::Before)
                ->color('success'),

            Stat::make('Siswa SIJA', $kosong)
                ->description('Kosong')
                ->descriptionIcon('bi-dash-circle', IconPosition::Before)
                ->color('gray'),

        ];
    }
}

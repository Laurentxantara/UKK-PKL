<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalSemua extends BaseWidget
{
    protected ?string $heading = 'Sistem Informasi Jaringan dan Aplikasi';
    protected function getStats(): array
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalIndustri= Industri::count();

        return [
            Stat::make('Total Siswa ', $totalSiswa)
                ->description('Semua siswa yang terdaftar')
                ->descriptionIcon('bi-book', IconPosition::Before)
                ->color('warning'),

            Stat::make('Total Guru ', $totalGuru)
                ->description('Semua guru yang terdaftar')
                ->descriptionIcon('bi-person-video3', IconPosition::Before)
                ->color('warning'),

            Stat::make('Total Industri ', $totalIndustri)
                ->description('Semua industri yang terdaftar')
                ->descriptionIcon('bi-building', IconPosition::Before)
                ->color('warning'),
        ];

    }
}

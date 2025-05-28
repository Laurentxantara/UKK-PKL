<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\SiswaResource\Widgets\SiswaChart;
use App\Filament\Resources\SiswaResource\Widgets\StatusPKL;
use App\Filament\Widgets\TotalSemua;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'bi-bar-chart-line';

    protected static string $view = 'filament.pages.dashboard';


    protected function getHeaderWidgets(): array
    {
        return [
            TotalSemua::class,
            StatusPKL::class,
            SiswaChart::class,
        ];
    }
}

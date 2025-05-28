<?php

namespace App\Filament\Resources\SiswaResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Siswa;

class SiswaChart extends ChartWidget
{
    protected static ?string $heading = 'Presentase Siswa PKL';
    protected static ?string $maxHeight = '250px';
    public function getColumnSpan(): int
    {
        return 1;
    }

    protected function getData(): array
    {
        $diterima = Siswa::where('status_pkl', 'diterima')->count();
        $kosong = Siswa::where('status_pkl','kosong')->count();
        $total = $diterima + $kosong;

        $diterimaPercent = $total > 0 ? round(($diterima / $total) * 100, 2) : 0;
        $kosongPercent = $total > 0 ? round(($kosong / $total) * 100, 2) : 0;
        return [
            
            'labels' => [
                "Diterima [$diterimaPercent%]", "Kosong [$kosongPercent%]"
            ],
            'datasets' => [
                [
                    'data' => [$diterima, $kosong],
                    'backgroundColor' => ['#169c95', '#E8F2F1'],
                ],
            ],
            'options' => [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'display' => false,
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'display' => false,
                ],
            ],
        ],
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
    
}


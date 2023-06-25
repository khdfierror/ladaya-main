<?php

namespace App\Filament\Resources\HalamanResource\Widgets;

use App\Models\Halaman;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class HalamanOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Semua Halaman', Halaman::all()->count()),
                       
        ];
    }
}

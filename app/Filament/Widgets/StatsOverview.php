<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $pemasukan = Transaction::incomes()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        $pengeluaran = Transaction::expense()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        $selisih = $pemasukan - $pengeluaran;

        return [
            Stat::make('Total Pemasukan', $pemasukan)
                ->description($pemasukan . ' increase')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Total Pengeluaran', $pengeluaran)
                ->description($pengeluaran . ' Decrease')
                ->color('danger')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Selisih', $selisih)
                ->description($selisih . ' Selisih'),
        ];
    }
}

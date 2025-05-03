<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $countProduk = Product::count();
        $transaksi = Transaction::count();

        return [
            Stat::make('Produk', $countProduk . ' Produk'),
            Stat::make('Transaksi', $transaksi . ' Transaksi'),
        ];
    }
}

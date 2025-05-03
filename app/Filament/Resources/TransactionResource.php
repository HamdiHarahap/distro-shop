<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?string $navigationGroup = 'Orders';

    public static function getNavigationBadgeColor(): ?string
    {
        $belumBayarCount = static::getModel()::where('status', 'Belum Bayar')->count();

        return $belumBayarCount > 0 ? 'warning' : '';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Belum Bayar')->count();
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'Belum Bayar' => 'Belum Bayar',
                        'Dibayar' => 'Dibayar',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.username')
                    ->label('Nama Customer'),
                TextColumn::make('product.nama')
                    ->label('Produk'),
                TextColumn::make('alamat')
                    ->label('Alamat Kirim')
                    ->wrap(),
                TextColumn::make('metode')
                    ->label('Metode Bayar'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Belum Bayar' => 'danger',
                        'Dibayar' => 'success',
                    }),
                ImageColumn::make('bukti')
                    ->label('Image')
                    ->disk('public')
                    ->url(fn ($record) => asset('storage/' . $record->bukti))
                    ->size(70)
                    ->placeholder('Tidak Ada Bukti'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Download All Transactions')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        $transactions = \App\Models\Transaction::with(['customer', 'product'])->get();
            
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.transactions', [
                            'transactions' => $transactions,
                        ]);
            
                        return response()->streamDownload(
                            fn () => print($pdf->stream()),
                            'transactions-report.pdf'
                        );
                    }),
            ])            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}

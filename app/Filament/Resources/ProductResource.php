<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Product Info')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Baju')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('harga')
                        ->label('Harga')
                        ->numeric()
                        ->required(),
                    Select::make('kategori')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'Kaos' => 'Kaos',
                            'Kemeja' => 'Kemeja',
                            'Polo' => 'Polo',
                        ]),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi'),
                    FileUpload::make('gambar')
                        ->label('Gambar')
                        ->columnSpanFull()
                        ->image()
                        ->directory('products'),
                ]),
            Section::make('Stocks')
                ->schema([
                    Repeater::make('stocks')
                        ->relationship('stocks')
                        ->schema([
                            Select::make('size')
                                ->options([
                                    'S' => 'Small',
                                    'M' => 'Medium',
                                    'L' => 'Large',
                                    'XL' => 'Extra Large',
                                ])
                                ->required(),
                            TextInput::make('stock')
                                ->numeric()
                                ->required(),
                        ])
                        ->columns(2)
                        ->createItemButtonLabel('Add Size Stock'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Baju'),
                TextColumn::make('harga')
                    ->label('Harga')
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format($state, 0, ',', '.');
                    }),
                TextColumn::make('kategori')
                    ->label('Kategori'),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->placeholder('Tidak Ada Deskripsi'),
                TextColumn::make('stocks')
                    ->label('Size & Stock')
                    ->formatStateUsing(function ($record) {
                        return $record->stocks->map(function ($stock) {
                            return "{$stock->size} ({$stock->stock})";
                        })->implode(', ');
                    }),      
                ImageColumn::make('gambar')
                    ->label('Image')
                    ->disk('public')
                    ->url(fn ($record) => asset('storage/' . $record->gambar))
                    ->size(70),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

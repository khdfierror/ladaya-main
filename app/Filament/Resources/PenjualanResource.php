<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\Bank;
use App\Models\Penjualan;
use App\Models\Tiket;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationLabel = 'Penjualan';
    

    public static function getPluralModelLabel(): string
    {
        return static::$navigationLabel;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')
                    ->label('No. Invoice')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_pelanggan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('hp_pelanggan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_pelanggan')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('tiket_id')
                    ->relationship('tiket', 'nama')
                    ->reactive()
                    ->afterStateUpdated(function($state, callable $get, callable $set){
                        $tiket = Tiket::find($state);
                        
                        if($tiket){
                            $set('harga', (string) $tiket->harga);

                            $total = doubleval($get('harga')) * intval($get('kuantiti'));
                            $set('total', (string) $total);
                        }
                    }),
                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->mask(
                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->thousandsSeparator(',')
                    ),
                Forms\Components\TextInput::make('kuantiti')
                    ->numeric()
                    ->mask(
                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->thousandsSeparator(',')
                    )->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $total = doubleval($get('harga')) * intval($get('kuantiti'));
                        $set('total', (string) $total);
                    }),
                Forms\Components\Select::make('bank_id')
                ->label('Bank')
                ->relationship('bank', 'nama'),

                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->mask(
                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->thousandsSeparator(',')
                    )
                    ->extraInputAttributes([
                        'readonly' => true
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor'),
                Tables\Columns\TextColumn::make('nama_pelanggan'),
                Tables\Columns\TextColumn::make('hp_pelanggan'),
                Tables\Columns\TextColumn::make('email_pelanggan'),
                Tables\Columns\TextColumn::make('tiket.nama'),
                Tables\Columns\TextColumn::make('harga')->money('idr'),
                Tables\Columns\TextColumn::make('kuantiti'),
                Tables\Columns\TextColumn::make('bank.nama'),
                Tables\Columns\TextColumn::make('total')->money('idr'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePenjualans::route('/'),
        ];
    }    
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokTanamanResource\Pages;
use App\Filament\Resources\StokTanamanResource\RelationManagers;
use App\Models\StokTanaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokTanamanResource extends Resource
{
    protected static ?string $model = StokTanaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\Select::make('spesies_id')
                ->relationship('spesies', 'nama_spesies')
                ->required()
                ->label('Spesies'),
            Forms\Components\TextInput::make('jumlah_stok')
                ->numeric()
                ->required()
                ->label('Jumlah Stok'),
            Forms\Components\DatePicker::make('tanggal_masuk')
                ->required()
                ->label('Tanggal Masuk'),
            Forms\Components\Select::make('sumber_dana')
                ->label('Sumber Dana')
                ->options([
                'apbd' => 'APBD',
                'csr' => 'CSR',
                'pribadi' => 'Pribadi',
    ])
    ->required(),
            Forms\Components\Textarea::make('keterangan')
                ->label('Keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('spesies.nama_spesies')
                ->label('Spesies'),
            Tables\Columns\TextColumn::make('jumlah_stok')
                ->label('Jumlah Stok'),
            Tables\Columns\TextColumn::make('tanggal_masuk')
                ->label('Tanggal Masuk')
                ->date(),
            Tables\Columns\TextColumn::make('sumber_dana')
                ->label('Sumber Dana')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
    public static function getModelLabel(): string
    {
    return 'Stok Tanaman';
    }

    public static function getPluralModelLabel(): string
    {
    return 'Stok Tanaman';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStokTanamen::route('/'),
            'create' => Pages\CreateStokTanaman::route('/create'),
            'edit' => Pages\EditStokTanaman::route('/{record}/edit'),
        ];
    }
}

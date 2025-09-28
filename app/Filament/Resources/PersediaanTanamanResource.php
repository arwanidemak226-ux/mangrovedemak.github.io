<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersediaanTanamanResource\Pages;
use App\Models\Spesies;
use App\Models\StokTanaman;
use App\Models\StokKeluar;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PersediaanTanamanResource extends Resource
{
    protected static ?string $model = Spesies::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Persediaan Tanaman';
    protected static ?string $pluralModelLabel = 'Persediaan Tanaman';
    protected static ?string $modelLabel = 'Persediaan Tanaman';

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make('export'),
            ])
            ->query(
                Spesies::query()
                    ->select('spesies.id', 'spesies.nama_spesies')
                    ->selectRaw('COALESCE(SUM(stok_tanaman.jumlah_stok),0) as total_masuk')
                    ->selectRaw('COALESCE(SUM(stok_keluar.jumlah_keluar),0) as total_keluar')
                    ->selectRaw('COALESCE(SUM(stok_tanaman.jumlah_stok),0) - COALESCE(SUM(stok_keluar.jumlah_keluar),0) as sisa_stok')
                    ->leftJoin('stok_tanaman', 'spesies.id', '=', 'stok_tanaman.spesies_id')
                    ->leftJoin('stok_keluar', 'spesies.id', '=', 'stok_keluar.spesies_id')
                    ->groupBy('spesies.id', 'spesies.nama_spesies')
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_spesies')
                    ->label('Spesies')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_masuk')
                    ->label('Total Masuk')
                    ->numeric(),

                Tables\Columns\TextColumn::make('total_keluar')
                    ->label('Total Keluar')
                    ->numeric(),

                Tables\Columns\TextColumn::make('sisa_stok')
                    ->label('Sisa Stok')
                    ->numeric()
                    ->color(fn ($state) => $state <= 0 ? 'danger' : 'success'),  
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
                ]),
            ]);
        
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersediaanTanamen::route('/'),
        ];
    }
}

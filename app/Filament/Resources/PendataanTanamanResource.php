<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendataanTanamanResource\Pages;
use App\Models\PendataanTanaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PendataanTanamanResource extends Resource
{
    protected static ?string $model = PendataanTanaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Pendataan Tanaman';

    protected static ?string $pluralModelLabel = 'Pendataan Tanaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lokasi_id')
                    ->relationship('lokasi', 'nama_lokasi')
                    ->required()
                    ->label('Lokasi Penanaman'),
                Forms\Components\Select::make('spesies_id')
                    ->relationship('spesies', 'nama_spesies')
                    ->required()
                    ->label('Spesies'),
                Forms\Components\DatePicker::make('tanggal_pendataan')
                    ->required()
                    ->label('Tanggal Pendataan'),
                Forms\Components\TextInput::make('jumlah_tanaman')
                    ->numeric()
                    ->required()
                    ->label('Jumlah Tanaman'),
                Forms\Components\TextInput::make('tinggi_rata_rata')
                    ->numeric()
                    ->required()
                    ->label('Tinggi Rata-rata (cm)'),
                Forms\Components\Select::make('kondisi_tanaman')
                    ->options([
                        'Sangat Baik' => 'Sangat Baik',
                        'Baik' => 'Baik',
                        'Kurang Baik' => 'Kurang Baik',
                        'Rusak' => 'Rusak',
                    ])
                    ->required()
                    ->label('Kondisi Tanaman'),
                Forms\Components\Select::make('kelompok_pengampu_id')
                    ->relationship('kelompokpengampu', 'nama_kelompok')
                    ->nullable()
                    ->label('Kelompok Pengampu'),
                Forms\Components\TextInput::make('anggaran')
                    ->numeric()
                    ->label('Anggaran'),
                Forms\Components\TextInput::make('luasan')
                    ->numeric()
                    ->label('Luasan (ha)'),
                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan'),
                Forms\Components\FileUpload::make('dokumentasi')
                    ->image()
                    ->multiple()
                    ->directory('dokumentasi')
                    ->disk('public')
                    ->label('Dokumentasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make('export'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('lokasi.nama_lokasi')->label('Lokasi Penanaman'),
                Tables\Columns\TextColumn::make('spesies.nama_spesies')->label('Spesies'),
                Tables\Columns\TextColumn::make('tanggal_pendataan')->date()->label('Tanggal Pendataan'),
                Tables\Columns\TextColumn::make('jumlah_tanaman')->label('Jumlah Tanaman'),
                Tables\Columns\TextColumn::make('kondisi_tanaman')->label('Kondisi'),
                Tables\Columns\TextColumn::make('kelompokpengampu.nama_kelompok')->label('Kelompok Pengampu'),
                Tables\Columns\TextColumn::make('anggaran')->label('Anggaran')->sortable(),
                Tables\Columns\TextColumn::make('luasan')->label('Luasan (ha)')->sortable(),
                Tables\Columns\TextColumn::make('catatan')->label('Catatan'),
                Tables\Columns\ImageColumn::make('dokumentasi')->disk('public')->label('Dokumentasi')->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListPendataanTanamen::route('/'),
            'create' => Pages\CreatePendataanTanaman::route('/create'),
            'edit' => Pages\EditPendataanTanaman::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokKeluarResource\Pages;
use App\Models\StokKeluar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StokKeluarResource extends Resource
{
    protected static ?string $model = StokKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-on-rectangle';

    public static function getModelLabel(): string
    {
        return 'Stok Keluar';
    }
    public static function getPluralModelLabel(): string
    {
        return 'Stok Keluar';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('spesies_id')
                    ->relationship('spesies', 'nama_spesies')
                    ->required()
                    ->label('Spesies'),

                Forms\Components\TextInput::make('nama_pemohon')
                    ->required()
                    ->label('Nama Pemohon'),

                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(20)
                    ->label('NIK'),
               Forms\Components\TextInput::make('jumlah_keluar')
                    ->numeric()
                    ->required()
                    ->label('Jumlah Keluar')
                    ->rules([
            function ($get, $record) {
            return function (string $attribute, $value, \Closure $fail) use ($get, $record) {
                $spesiesId = $get('spesies_id');

                if ($spesiesId) {
                    // Hitung total masuk dari stok_tanaman
                    $totalMasuk = \App\Models\StokTanaman::where('spesies_id', $spesiesId)->sum('jumlah_stok');

                    // Hitung total keluar untuk spesies ini, kecuali record yang sedang diedit
                    $queryKeluar = \App\Models\StokKeluar::where('spesies_id', $spesiesId);
                    if ($record) {
                        $queryKeluar->where('id', '!=', $record->id);
                    }
                    $totalKeluar = $queryKeluar->sum('jumlah_keluar');

                    // Hitung sisa stok
                    $sisaStok = $totalMasuk - $totalKeluar;

                    if ($value > $sisaStok) {
                        $fail("Stok tidak mencukupi. Sisa stok: {$sisaStok}");
                                  }
                            }
                        };
                    },
                 ]),

                Forms\Components\DatePicker::make('tanggal_keluar')
                    ->required()
                    ->label('Tanggal Keluar'),

                Forms\Components\Select::make('sumber_dana')
                    ->label('Sumber Dana')
                    ->options([
                        'apbd' => 'APBD',
                        'csr' => 'CSR',
                        'pribadi' => 'Pribadi',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('spesies.nama_spesies')
                    ->label('Spesies')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah_keluar')
                    ->label('Jumlah Keluar'),

                Tables\Columns\TextColumn::make('tanggal_keluar')
                    ->label('Tanggal Keluar')
                    ->date(),

                Tables\Columns\TextColumn::make('sumber_dana')
                    ->label('Sumber Dana')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStokKeluars::route('/'),
            'create' => Pages\CreateStokKeluar::route('/create'),
            'edit' => Pages\EditStokKeluar::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SepadanSungaiResource\Pages;
use App\Filament\Resources\SepadanSungaiResource\RelationManagers;
use App\Models\SepadanSungai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;


class SepadanSungaiResource extends Resource
{
    protected static ?string $model = SepadanSungai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     protected static ?string $modelLabel = 'Sepadan Sungai';

    protected static ?string $pluralModelLabel = 'Sepadan Sungai';

    public static function shouldRegisterNavigation(): bool
{
    return false; // ✅ menu tidak akan tampil di sidebar
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_sungai')
                    ->required()
                    ->label('Nama Sungai'),
                Forms\Components\TextInput::make('titik_koordinat')
                    ->label('Titik Koordinat'),
                Forms\Components\TextInput::make('luas_m2')
                    ->numeric()
                    ->label('Luas (m²)'),
                Forms\Components\Select::make('kecamatan')
                    ->options([
                        'Karangtengah' => 'Karangtengah',
                        'Bonang' => 'Bonang',
                        'Sayung' => 'Sayung',
                        'Wedung' => 'Wedung',
                    ])
                    ->label('Kecamatan')
                    ->live(),
                Forms\Components\Select::make('desa')
                    ->label('Desa')
                    ->options(fn (Forms\Get $get): Collection => match($get('kecamatan')) {
                        'Sayung' => collect([
                            'Banjarsari', 'Bedono', 'Bulusari', 'Dombo', 'Gemulak', 'Jetaksari', 'Kalisari', 'Karangasem', 'Loireng', 'Pilangsari', 'Prampelan', 'Purwosari', 'Sayung', 'Sidogemah', 'Sidorejo', 'Sriwulan', 'Surodadi', 'Tambakroto', 'Timbulsloko', 'Tugu',
                        ])->mapWithKeys(fn ($item) => [$item => $item]),
                        'Karangtengah' => collect([
                            'Batu', 'Donorejo', 'Dukun', 'Grogol', 'Karangsari', 'Karangtowo', 'Kedunguter', 'Klitih', 'Pidodo', 'Ploso', 'Pulosari', 'Rejosari', 'Sampang', 'Tambakbulusan', 'Wonoagung', 'Wonokerto', 'Wonowoso',
                        ])->mapWithKeys(fn ($item) => [$item => $item]),
                        'Bonang' => collect([
                            'Betahwalang', 'Bonangrejo', 'Gebang', 'Gebangarum', 'Jali', 'Jatimulyo', 'Jatirogo', 'Karangrejo', 'Kembangan', 'Krajanbogo', 'Margolinduk', 'Morodemak', 'Poncoharjo', 'Purworejo', 'Serangan', 'Sukodono', 'Sumberejo', 'Tlogoboyo', 'Tridonorejo', 'Weding', 'Wonosari',
                        ])->mapWithKeys(fn ($item) => [$item => $item]),
                        'Wedung' => collect([
                            'Babalan', 'Berahan Kulon', 'Berahan Wetan', 'Buko', 'Bungo', 'Jetak', 'Jungpasir', 'Jungsemi', 'Kedungkarang', 'Kedungmutih', 'Kendalasem', 'Kenduren', 'Mandung', 'Mutih Kulon', 'Mutih Wetan', 'Ngawen', 'Ruwit', 'Tedunan', 'Tempel', 'Wedung',
                        ])->mapWithKeys(fn ($item) => [$item => $item]),
                        default => collect(),
                    }),
                Forms\Components\Select::make('status_kondisi')
                    ->options([
                        'Terkonservasi' => 'Terkonservasi',
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Rusak Parah' => 'Rusak Parah',
                    ])
                    ->label('Status Kondisi'),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                  Tables\Columns\TextColumn::make('nama_sungai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titik_koordinat'),
                Tables\Columns\TextColumn::make('luas_m2')
                    ->label('Luas (m²)'),
                Tables\Columns\TextColumn::make('kecamatan'),
                Tables\Columns\TextColumn::make('desa'),
                Tables\Columns\TextColumn::make('status_kondisi')
                    ->label('Status Kondisi'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSepadanSungais::route('/'),
            'create' => Pages\CreateSepadanSungai::route('/create'),
            'edit' => Pages\EditSepadanSungai::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LahanPribadiResource\Pages;
use App\Models\LahanPribadi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection; // Tambahkan ini

class LahanPribadiResource extends Resource
{
    protected static ?string $model = LahanPribadi::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Lahan Pribadi';
    protected static ?string $pluralModelLabel = 'Lahan Pribadi';
    public static function shouldRegisterNavigation(): bool
{
    return false; // ✅ menu tidak akan tampil di sidebar
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pemilik')
                    ->required()
                    ->label('Nama Pemilik'),
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat'),
                Forms\Components\TextInput::make('luas_ha')
                    ->numeric()
                    ->label('Luas (ha)'),
                Forms\Components\Select::make('status_lahan')
                    ->options([
                        'Sertifikat Hak Milik' => 'Sertifikat Hak Milik',
                        'Lahan Sewa' => 'Lahan Sewa',
                        'Tanah Hibah' => 'Tanah Hibah',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->label('Status Lahan'),
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
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan'),
            ]);
    }
    
    // ... bagian table, relations, dan pages di bawahnya tetap sama
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemilik')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('luas_ha')
                    ->label('Luas (ha)'),
                Tables\Columns\TextColumn::make('status_lahan')
                    ->label('Status Lahan'),
                Tables\Columns\TextColumn::make('kecamatan'),
                Tables\Columns\TextColumn::make('desa'),
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
            'index' => Pages\ListLahanPribadis::route('/'),
            'create' => Pages\CreateLahanPribadi::route('/create'),
            'edit' => Pages\EditLahanPribadi::route('/{record}/edit'),
        ];
    }
}
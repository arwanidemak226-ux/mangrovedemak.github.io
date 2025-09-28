<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LokasiPenanamanResource\Pages;
use App\Models\LokasiPenanaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Illuminate\Support\Collection;

class LokasiPenanamanResource extends Resource
{
    protected static ?string $model = LokasiPenanaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $pluralModelLabel = 'Lokasi penanaman'; // Baris ini yang diubah

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lokasi') // Diganti dari nama_lokasi
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('kecamatan')
                    ->label('Kecamatan (Pesisir Demak)')
                    ->options([
                        'Sayung' => 'Sayung',
                        'Karangtengah' => 'Karangtengah',
                        'Bonang' => 'Bonang',
                        'Wedung' => 'Wedung',
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn (Forms\Set $set) => $set('desa', null)),
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
                    })
                    ->nullable()
                    ->searchable(),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_penanaman')
                    ->nullable()
                    ->label('Tanggal Penanaman'),
                RichEditor::make('deskripsi')
                    ->columnSpanFull()
                    ->nullable(),
                FileUpload::make('gambar')
                    ->multiple()
                    ->directory('lokasi-images')
                    ->visibility('public')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lokasi') // Diganti dari nama_lokasi
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->label('Kecamatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('desa')
                    ->label('Desa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penanaman')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('gambar')
                    ->disk('public') 
                    ->label('Gambar')
                    ->circular()
                    ->stacked()
                    ->visibility('visible'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()->label('Ekspor Data'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
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
            'index' => Pages\ListLokasiPenanamen::route('/'),
            'create' => Pages\CreateLokasiPenanaman::route('/create'),
            'edit' => Pages\EditLokasiPenanaman::route('/{record}/edit'),
        ];
    }
}
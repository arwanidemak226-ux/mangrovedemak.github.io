<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanahDesaResource\Pages;
use App\Models\TanahDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TanahDesaResource extends Resource
{
    protected static ?string $model = TanahDesa::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tanah Desa';
    public static function getNavigationBadge(): ?string
    {
    return null;
    }  
    public static function shouldRegisterNavigation(): bool
{
    return false; // ✅ menu tidak akan tampil di sidebar
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lahan')
                    ->required()
                    ->label('Nama Lahan'),

                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat'),

                Forms\Components\TextInput::make('luas_ha')
                    ->numeric()
                    ->required()
                    ->suffix('ha')
                    ->label('Luas Lahan'),

                Forms\Components\Select::make('status_kepemilikan')
                    ->label('Status Kepemilikan')
                    ->required()
                    ->options([
                        'Tanah Desa' => 'Tanah Desa',
                        'Pribadi' => 'Pribadi',
                    ]),

                Forms\Components\Select::make('kecamatan')
                    ->label('Kecamatan')
                    ->required()
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
                    ->required()
                    ->options(fn (Forms\Get $get) => match($get('kecamatan')) {
                        'Sayung' => collect([
                            'Banjarsari','Bedono','Bulusari','Dombo','Gemulak','Jetaksari',
                            'Kalisari','Karangasem','Loireng','Pilangsari','Prampelan',
                            'Purwosari','Sayung','Sidogemah','Sidorejo','Sriwulan','Surodadi',
                            'Tambakroto','Timbulsloko','Tugu',
                        ])->mapWithKeys(fn($item) => [$item => $item]),

                        'Karangtengah' => collect([
                            'Batu','Donorejo','Dukun','Grogol','Karangsari','Karangtowo',
                            'Kedunguter','Klitih','Pidodo','Ploso','Pulosari','Rejosari',
                            'Sampang','Tambakbulusan','Wonoagung','Wonokerto','Wonowoso',
                        ])->mapWithKeys(fn($item) => [$item => $item]),

                        'Bonang' => collect([
                            'Betahwalang','Bonangrejo','Gebang','Gebangarum','Jali','Jatimulyo',
                            'Jatirogo','Karangrejo','Kembangan','Krajanbogo','Margolinduk',
                            'Morodemak','Poncoharjo','Purworejo','Serangan','Sukodono',
                            'Sumberejo','Tlogoboyo','Tridonorejo','Weding','Wonosari',
                        ])->mapWithKeys(fn($item) => [$item => $item]),

                        'Wedung' => collect([
                            'Babalan','Berahan Kulon','Berahan Wetan','Buko','Bungo','Jetak',
                            'Jungpasir','Jungsemi','Kedungkarang','Kedungmutih','Kendalasem',
                            'Kenduren','Mandung','Mutih Kulon','Mutih Wetan','Ngawen','Ruwit',
                            'Tedunan','Tempel','Wedung',
                        ])->mapWithKeys(fn($item) => [$item => $item]),

                        default => collect([]),
                    })
                    ->searchable(),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lahan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('luas_ha')
                    ->label('Luas (ha)')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . ' ha'),
                Tables\Columns\TextColumn::make('status_kepemilikan'),
                Tables\Columns\TextColumn::make('kecamatan'),
                Tables\Columns\TextColumn::make('desa'),
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
    public static function getModelLabel(): string
    {
    return 'Tanah Desa';
    }

    public static function getPluralModelLabel(): string
    {
    return 'Tanah Desa';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTanahDesas::route('/'),
            'create' => Pages\CreateTanahDesa::route('/create'),
            'edit' => Pages\EditTanahDesa::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelompokPengampuResource\Pages;
use App\Models\KelompokPengampu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KelompokPengampuResource extends Resource
{
    protected static ?string $model = KelompokPengampu::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Pengaju')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jabatan')
                    ->options([
                        'Ketua' => 'Ketua',
                        'Sekretaris' => 'Sekretaris',
                        'Bendahara' => 'Bendahara',
                        'Anggota' => 'Anggota',
                    ])
                    ->label('Jabatan')
                    ->required(),
                Forms\Components\TextInput::make('nama_kelompok')
                    ->label('Nama Kelompok')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('kontak')
                    ->label('Kontak (HP/Email)')
                    ->nullable(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('sk_akta_notaris')
                    ->image()
                    ->label('SK Akta Notaris')
                    ->nullable(),
                Forms\Components\FileUpload::make('sk_kepala_desa')
                    ->image()
                    ->label('SK Kepala Desa')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make('export'),
               ])
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pengaju')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_kelompok')
                    ->label('Nama Kelompok')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('sk_akta_notaris')
                    ->label('SK Akta Notaris'),
                Tables\Columns\ImageColumn::make('sk_kepala_desa')
                    ->label('SK Kepala Desa'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
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
        return [];
    }

    public static function getModelLabel(): string
    {
        return 'Kelompok Pengampu';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Kelompok Pengampu';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelompokPengampus::route('/'),
            'create' => Pages\CreateKelompokPengampu::route('/create'),
            'edit' => Pages\EditKelompokPengampu::route('/{record}/edit'),
        ];
    }
}

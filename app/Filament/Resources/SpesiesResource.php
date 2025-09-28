<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpesiesResource\Pages;
use App\Models\Spesies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Actions\BulkActionGroup;



class SpesiesResource extends Resource
{
    protected static ?string $model = Spesies::class;

    protected static ?string $navigationIcon =  'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_spesies')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_lokal')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('deskripsi')
                    ->nullable()
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->multiple()
                    ->directory('spesies-images')
                    ->visibility('public')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_spesies')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_lokal')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->stacked()
                    ->limit(2)
                    ->toggleable(),
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
                ExportAction::make()
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
            'index' => Pages\ListSpesies::route('/'),
            'create' => Pages\CreateSpesies::route('/create'),
            'edit' => Pages\EditSpesies::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShortenerResource\Pages;
use App\Models\Shortener;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShortenerResource extends Resource
{
    protected static ?string $model = Shortener::class;
    protected static ?string $navigationIcon = 'heroicon-c-link';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_url')
                    ->prefix('https://')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('shorten_url', self::generateShortenUrl());
                    }),
                Forms\Components\TextInput::make('shorten_url')
                    ->prefix('https://bsmnt.pro/')
                    ->label('Generative URL')
                    ->unique()
                    ->maxLength(255)
            ]);
    }

    private static function generateShortenUrl(): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(7 / strlen($x)))), 1, 7);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('original_url')
                    ->label('Original URL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shorten_url')
                    ->label('Shorten URL')
                    ->openUrlInNewTab()
                    ->url(function ($record) {
                        return $record->original_url;
                    })
                    ->formatStateUsing(function ($state) {
                        return ('https://bsmnt.pro/' . $state);
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListShorteners::route('/'),
            'create' => Pages\CreateShortener::route('/create'),
            'edit' => Pages\EditShortener::route('/{record}/edit'),
        ];
    }
}

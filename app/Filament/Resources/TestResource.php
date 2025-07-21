<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('display_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('language')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_counselor')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('price_counselee')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('counter_counselor')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('counter_counselee')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('activated')
                    ->required(),
                Forms\Components\TextInput::make('external_id')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_counselor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_counselee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('counter_counselor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('counter_counselee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('activated')
                    ->boolean(),
                Tables\Columns\TextColumn::make('external_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}

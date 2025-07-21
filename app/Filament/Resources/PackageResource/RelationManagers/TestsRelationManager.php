<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestsRelationManager extends RelationManager
{
    protected static string $relationship = 'tests';

    protected static ?string $recordTitleAttribute = 'display_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('display_name')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->helperText('Test details are managed in the Tests section'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('display_name')
            ->columns([
                Tables\Columns\TextColumn::make('display_name')
                    ->label('Test Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('language')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'English' => 'success',
                        'Hindi' => 'info',
                        'Bengali' => 'warning',
                        'Gujarati' => 'danger',
                        'Tamil' => 'gray',
                        'Telugu' => 'primary',
                        'Marathi' => 'secondary',
                        'Punjabi' => 'success',
                        'Kannada' => 'info',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('activated')
                    ->boolean()
                    ->label('Status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_counselor')
                    ->money('INR')
                    ->sortable()
                    ->label('Counselor Price'),
                Tables\Columns\TextColumn::make('price_counselee')
                    ->money('INR')
                    ->sortable()
                    ->label('Counselee Price'),
                Tables\Columns\TextColumn::make('total_usage')
                    ->label('Usage')
                    ->state(fn (Test $record): int => $record->total_usage)
                    ->badge()
                    ->color(fn (int $state): string => $state > 200 ? 'success' : ($state > 50 ? 'warning' : 'gray'))
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->options([
                        'English' => 'English',
                        'Hindi' => 'Hindi',
                        'Bengali' => 'Bengali',
                        'Gujarati' => 'Gujarati',
                        'Marathi' => 'Marathi',
                        'Tamil' => 'Tamil',
                        'Telugu' => 'Telugu',
                        'Punjabi' => 'Punjabi',
                        'Kannada' => 'Kannada',
                    ])
                    ->label('Language'),
                Tables\Filters\TernaryFilter::make('activated')
                    ->label('Status')
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['display_name', 'name'])
                    ->recordTitle(fn (Test $record): string => "{$record->display_name} ({$record->language})")
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No tests included')
            ->emptyStateDescription('Attach tests to this package to get started.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }
}

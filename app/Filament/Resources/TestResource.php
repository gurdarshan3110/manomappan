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
use Filament\Tables\Enums\ActionsPosition;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Tests';

    protected static ?string $modelLabel = 'Test';

    protected static ?string $pluralModelLabel = 'Tests';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Enter the basic test details and identification')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., mz_aptitude_test')
                            ->helperText('Internal test identifier'),
                        Forms\Components\TextInput::make('display_name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Mz Aptitude Test')
                            ->helperText('Display name for users'),
                        Forms\Components\Select::make('language')
                            ->required()
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
                            ->searchable()
                            ->placeholder('Select language'),
                        Forms\Components\Toggle::make('activated')
                            ->required()
                            ->default(true)
                            ->helperText('Whether this test is available for users'),
                    ]),

                Forms\Components\Section::make('Pricing Information')
                    ->description('Configure pricing for counselors and counselees')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('price_counselor')
                            ->required()
                            ->numeric()
                            ->prefix('₹')
                            ->default(0)
                            ->placeholder('0')
                            ->helperText('Price charged to counselors'),
                        Forms\Components\TextInput::make('price_counselee')
                            ->required()
                            ->numeric()
                            ->prefix('₹')
                            ->default(0)
                            ->placeholder('0')
                            ->helperText('Price charged to counselees'),
                    ]),

                Forms\Components\Section::make('Usage Statistics')
                    ->description('Track test usage and performance metrics')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('counter_counselor')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->placeholder('0')
                            ->helperText('Number of times used by counselors')
                            ->disabled(fn ($context) => $context === 'create'),
                        Forms\Components\TextInput::make('counter_counselee')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->placeholder('0')
                            ->helperText('Number of times used by counselees')
                            ->disabled(fn ($context) => $context === 'create'),
                    ]),

                Forms\Components\Section::make('System Information')
                    ->description('External system integration and sync details')
                    ->schema([
                        Forms\Components\TextInput::make('external_id')
                            ->maxLength(255)
                            ->placeholder('External system ID for sync')
                            ->helperText('MongoDB ID from external API (auto-populated during sync)')
                            ->disabled(fn ($context) => $context === 'create')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date Added'),
                Tables\Columns\TextColumn::make('display_name')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    })
                    ->searchable()
                    ->label('Test Name')
                    ->description(fn (Test $record): string => $record->name),
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
                Tables\Columns\TextColumn::make('counter_counselor')
                    ->numeric()
                    ->sortable()
                    ->label('Counselor Usage')
                    ->badge()
                    ->color(fn (int $state): string => $state > 100 ? 'success' : ($state > 10 ? 'warning' : 'gray')),
                Tables\Columns\TextColumn::make('counter_counselee')
                    ->numeric()
                    ->sortable()
                    ->label('Counselee Usage')
                    ->badge()
                    ->color(fn (int $state): string => $state > 100 ? 'success' : ($state > 10 ? 'warning' : 'gray')),
                Tables\Columns\TextColumn::make('total_usage')
                    ->label('Total Usage')
                    ->state(fn (Test $record): int => $record->total_usage)
                    ->badge()
                    ->color(fn (int $state): string => $state > 200 ? 'success' : ($state > 50 ? 'warning' : 'gray'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('external_id')
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 20 ? $state : null;
                    })
                    ->searchable()
                    ->label('External ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->label('Language')
                    ->placeholder('All Languages'),
                Tables\Filters\TernaryFilter::make('activated')
                    ->label('Status')
                    ->placeholder('All Statuses')
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only'),
                Tables\Filters\SelectFilter::make('name')
                    ->options([
                        'mz_6_section_aptitude_test' => 'Potential Profile',
                        'mz_aptitude_test' => 'Aptitude Test',
                        'mz_holistic_test' => 'Holistic Profiling',
                        'mz_interest_test' => 'Interest Test',
                        'mz_personality_test' => 'Personality Test',
                    ])
                    ->label('Test Type')
                    ->placeholder('All Test Types'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions'),
            ])
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['activated' => true]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Activate Selected Tests')
                        ->modalDescription('Are you sure you want to activate all selected tests?'),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each->update(['activated' => false]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Deactivate Selected Tests')
                        ->modalDescription('Are you sure you want to deactivate all selected tests?'),
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

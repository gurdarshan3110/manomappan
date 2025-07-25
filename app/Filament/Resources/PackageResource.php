<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Enter the basic package details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('plan_name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter plan name'),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('₹')
                            ->placeholder('Enter price'),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options(Package::getStatusList())
                            ->default(Package::STATUS_ACTIVE),
                        Forms\Components\TextInput::make('counsellor')
                            ->maxLength(255)
                            ->placeholder('Enter counsellor details'),
                    ]),

                Forms\Components\Section::make('Package Features')
                    ->description('Configure package features and details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('language')
                            ->maxLength(255)
                            ->placeholder('Available languages'),
                        Forms\Components\TextInput::make('report')
                            ->maxLength(255)
                            ->placeholder('Report details'),
                        Forms\Components\TextInput::make('ai_drive_career_support')
                            ->maxLength(255)
                            ->placeholder('AI career support details'),
                        Forms\Components\TextInput::make('career_counselling_session')
                            ->maxLength(255)
                            ->placeholder('Counselling session details'),
                        Forms\Components\TextInput::make('sessions_with_role_model_and_parents')
                            ->maxLength(255)
                            ->placeholder('Role model sessions details'),
                        Forms\Components\TextInput::make('certified_expert_guidence')
                            ->maxLength(255)
                            ->placeholder('Expert guidance details'),
                    ]),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->placeholder('Enter package description')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Included Tests')
                    ->description('Select tests that are included in this package')
                    ->schema([
                        Forms\Components\Select::make('tests')
                            ->relationship('tests', 'display_name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->optionsLimit(50)
                            ->getSearchResultsUsing(fn (string $search): array => Test::where('display_name', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->limit(50)
                                ->get()
                                ->mapWithKeys(fn ($test) => [$test->id => "{$test->display_name} ({$test->language}) - {$test->name}"])
                                ->toArray())
                            ->getOptionLabelsUsing(fn (array $values): array => Test::whereIn('id', $values)
                                ->get()
                                ->mapWithKeys(fn ($test) => [$test->id => "{$test->display_name} ({$test->language}) - {$test->name}"])
                                ->toArray())
                            ->helperText('Select multiple tests to include in this package')
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan_name')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Package::STATUS_ACTIVE => 'success',
                        Package::STATUS_INACTIVE => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('tests_count')
                    ->label('Tests Count')
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'success' : 'gray')
                    ->counts('tests')
                    ->sortable(),
                Tables\Columns\TextColumn::make('counsellor')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 20 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('report')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('ai_drive_career_support')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('career_counselling_session')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('sessions_with_role_model_and_parents')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('certified_expert_guidence')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    })
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
                Tables\Filters\SelectFilter::make('status')
                    ->options(Package::getStatusList())
                    ->label('Status')
                    ->placeholder('All Statuses'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions'),
            ])
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}

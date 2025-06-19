<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerClusterResource\Pages;
use App\Filament\Resources\CareerClusterResource\RelationManagers;
use App\Models\CareerCluster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CareerClusterResource extends Resource
{
    protected static ?string $model = CareerCluster::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Career';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Cluster';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Enter the basic cluster details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter cluster name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Auto-generated from name')
                            // ->disabled()
                            ->dehydrated(),

                        Forms\Components\Select::make('status')
                            ->options(CareerCluster::getStatusList())
                            ->default(CareerCluster::STATUS_DRAFT)
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->placeholder('Enter display order number'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->description('Upload cluster image and details')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->directory('career-clusters')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('thumbnail_alt')
                            ->maxLength(255)
                            ->placeholder('Enter image alt text for accessibility'),
                    ]),

                Forms\Components\Section::make('Content')
                    ->description('Add cluster description and details')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull()
                            ->placeholder('Enter cluster description'),
                    ]),

                Forms\Components\Section::make('SEO Information')
                    ->description('Configure SEO settings')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->maxLength(255)
                            ->placeholder('Enter SEO title'),
                        Forms\Components\Textarea::make('seo_description')
                            ->placeholder('Enter SEO description')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->square(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        CareerCluster::STATUS_PUBLISHED => 'success',
                        CareerCluster::STATUS_DRAFT => 'warning',
                        CareerCluster::STATUS_ARCHIVED => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(CareerCluster::getStatusList())
                    ->label('Status')
                    ->placeholder('All Statuses'),
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
            'index' => Pages\ListCareerClusters::route('/'),
            'create' => Pages\CreateCareerCluster::route('/create'),
            'edit' => Pages\EditCareerCluster::route('/{record}/edit'),
        ];
    }
}

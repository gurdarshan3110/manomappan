<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Filament\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Career';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Enter the basic career details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter career title')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                                $set('seo_title', $state);
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Auto-generated from title')
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('cluster_id')
                            ->relationship('cluster', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options(Career::getStatusList())
                            ->required()
                            ->default(Career::STATUS_DRAFT),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->placeholder('Enter display order'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->description('Upload career images')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->directory('careers')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('thumbnail_alt')
                            ->maxLength(255)
                            ->placeholder('Enter image alt text'),
                    ]),

                Forms\Components\Section::make('Career Sections')
                    ->description('Add content sections for this career')
                    ->schema([
                        Forms\Components\Repeater::make('sections')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('section_title')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter section title'),
                                Forms\Components\RichEditor::make('section_content')
                                    ->required()
                                    ->placeholder('Enter section content'),
                                Forms\Components\FileUpload::make('section_image')
                                    ->image()
                                    ->directory('career-sections'),
                                Forms\Components\TextInput::make('section_order')
                                    ->numeric()
                                    ->required()
                                    ->default(fn ($operation) => $operation === 'create' ? 1 : null),
                            ])
                            ->orderable('section_order')
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Related Careers')
                    ->description('Link to related career paths')
                    ->schema([
                        Forms\Components\Select::make('relatedCareers')
                            ->multiple()
                            ->relationship('relatedCareers', 'title')
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('SEO Information')
                    ->description('Configure SEO settings')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->maxLength(255)
                            ->placeholder('Enter SEO title'),
                        Forms\Components\Textarea::make('seo_description')
                            ->placeholder('Enter meta description'),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->placeholder('Enter meta keywords'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('cluster.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->square(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Career::STATUS_PUBLISHED => 'success',
                        Career::STATUS_DRAFT => 'warning',
                        Career::STATUS_ARCHIVED => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Career::getStatusList())
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('cluster')
                    ->relationship('cluster', 'name')
                    ->label('Cluster')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}

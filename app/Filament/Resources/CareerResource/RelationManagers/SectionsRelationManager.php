<?php

namespace App\Filament\Resources\CareerResource\RelationManagers;

use App\Models\CareerSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('form_type')
                    ->label('Section Type')
                    ->searchable()
                    ->options(CareerSection::getTypeList())
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Forms\Set $set) => $set('form_data', null)),

                Forms\Components\TextInput::make('section_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(1)
                    ->required(),

                // Dynamic form fields based on form_type
                Forms\Components\Group::make()
                    ->columnSpanFull()
                    ->schema(fn (Forms\Get $get) => $this->getFormFieldsForType($get('form_type')))
                    ->visible(fn (Forms\Get $get) => filled($get('form_type'))),

                // Legacy fields (keeping for backward compatibility)
                // Forms\Components\Section::make('Legacy Fields')
                //     ->schema([
                //         Forms\Components\TextInput::make('section_title')
                //             ->label('Section Title (Legacy)')
                //             ->maxLength(255),

                //         Forms\Components\RichEditor::make('section_content')
                //             ->label('Section Content (Legacy)')
                //             ->rows(4),

                //         Forms\Components\FileUpload::make('section_image')
                //             ->label('Section Image (Legacy)')
                //             ->image()
                //             ->directory('career-sections'),
                //     ])
                //     ->collapsed()
                //     ->collapsible(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('form_type')
            ->columns([
                Tables\Columns\TextColumn::make('form_type')
                    ->label('Section Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => CareerSection::CAREER_FORM_TYPE[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'CAREER_SUMMARY' => 'success',
                        'HOW_TO_START' => 'info',
                        'ENTRANCE_EXAM' => 'warning',
                        'CAREER_PROSPECTS' => 'primary',
                        'CHALLENGES_AND_SKILL_SET_REQUIRED' => 'danger',
                        'FAQS' => 'gray',
                        'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES' => 'success',
                        'MARKET_TREND_AND_SALARY' => 'warning',
                        'PROS_AND_CONS' => 'info',
                        'STALWARTS_OF_THE_CAREER' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('section_order')
                    ->label('Order')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('form_data')
                //     ->label('Data Preview')
                //     ->limit(50)
                //     ->formatStateUsing(function ($state, $record) {
                //         if (!$state) return 'No data';
                        
                //         $data = is_array($state) ? $state : json_decode($state, true);
                //         $preview = '';
                        
                //         if (isset($data['items']) && is_array($data['items'])) {
                //             $count = count($data['items']);
                //             $preview = "{$count} items";
                //         } elseif (is_array($data)) {
                //             $keys = array_keys($data);
                //             $preview = implode(', ', array_slice($keys, 0, 3));
                //             if (count($keys) > 3) $preview .= '...';
                //         }
                        
                //         return $preview ?: 'Data available';
                //     }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('form_type')
                    ->options(CareerSection::getTypeList()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Section'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('section_order');
    }

    private function getFormFieldsForType(?string $type): array
    {
        if (!$type) {
            return [];
        }

        switch ($type) {
            case 'CAREER_SUMMARY':
            case 'HOW_TO_START':
            case 'CAREER_PROSPECTS':
            case 'MARKET_TREND_AND_SALARY':
                return [
                    Forms\Components\Repeater::make('form_data.items')
                        ->label('Items')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                        ])
                        ->defaultItems(1)
                        ->collapsible()
                        ->addActionLabel('Add Item'),
                ];

            case 'ENTRANCE_EXAM':
                return [
                    Forms\Components\Repeater::make('form_data.items')
                        ->label('Exam Information')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                        ])
                        ->defaultItems(1)
                        ->collapsible(),

                    Forms\Components\RichEditor::make('form_data.difficulty_level')
                        ->label('Difficulty Level'),

                    Forms\Components\RichEditor::make('form_data.preparation_tips')
                        ->label('Preparation Tips'),
                ];

            case 'CHALLENGES_AND_SKILL_SET_REQUIRED':
                return [
                    Forms\Components\Section::make('Challenges')
                        ->schema([
                            Forms\Components\Repeater::make('form_data.challenges.items')
                                ->label('Challenges')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('description')
                                        ->required(),
                                ])
                                ->defaultItems(1)
                                ->collapsible(),
                        ]),

                    Forms\Components\Section::make('Required Skills')
                        ->schema([
                            Forms\Components\Repeater::make('form_data.skill_set_required.items')
                                ->label('Skills Required')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('description')
                                        ->required(),
                                ])
                                ->defaultItems(1)
                                ->collapsible(),
                        ]),
                ];

            case 'FAQS':
                return [
                    Forms\Components\Repeater::make('form_data.items')
                        ->label('Frequently Asked Questions')
                        ->schema([
                            Forms\Components\TextInput::make('question')
                                ->required()
                                ->maxLength(500),
                            Forms\Components\RichEditor::make('answer')
                                ->required(),
                        ])
                        ->columns(1)
                        ->defaultItems(1)
                        ->collapsible()
                        ->addActionLabel('Add FAQ'),
                ];

            case 'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES':
                return [
                    Forms\Components\Repeater::make('form_data.items')
                        ->label('Educational Institutions')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                        ])
                        ->defaultItems(1)
                        ->collapsible()
                        ->addActionLabel('Add Institution'),
                ];

            case 'PROS_AND_CONS':
                return [
                    Forms\Components\Section::make('Pros')
                        ->schema([
                            Forms\Components\Repeater::make('form_data.pros.items')
                                ->label('Advantages')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('description')
                                        ->required(),
                                ])
                                ->defaultItems(1)
                                ->collapsible(),
                        ]),

                    Forms\Components\Section::make('Cons')
                        ->schema([
                            Forms\Components\Repeater::make('form_data.cons.items')
                                ->label('Disadvantages')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('description')
                                        ->required(),
                                ])
                                ->defaultItems(1)
                                ->collapsible(),
                        ]),
                ];

            case 'STALWARTS_OF_THE_CAREER':
                return [
                    Forms\Components\Repeater::make('form_data.items')
                        ->label('Career Stalwarts')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\FileUpload::make('image')
                                ->image()
                                ->directory('stalwarts')
                                ->imageEditor(),

                            Forms\Components\RichEditor::make('description')
                                ->columnSpanFull()
                                ->required(),

                            Forms\Components\TextInput::make('instagram_link')
                                ->url()
                                ->prefix('https://')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('facebook_link')
                                ->url()
                                ->prefix('https://')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('x_link')
                                ->label('X (Twitter) Link')
                                ->url()
                                ->prefix('https://')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('linkedin_link')
                                ->url()
                                ->prefix('https://')
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->defaultItems(1)
                        ->collapsible()
                        ->addActionLabel('Add Stalwart'),
                ];

            default:
                return [];
        }
    }
}

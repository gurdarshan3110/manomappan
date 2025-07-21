<?php

namespace App\Filament\Resources\TestResource\RelationManagers;

use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'packages';

    protected static ?string $recordTitleAttribute = 'plan_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('plan_name')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->helperText('Package details are managed in the Packages section'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('plan_name')
            ->columns([
                Tables\Columns\TextColumn::make('plan_name')
                    ->label('Package Name')
                    ->searchable()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('counsellor')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Package::getStatusList())
                    ->label('Status'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['plan_name'])
                    ->recordTitle(fn (Package $record): string => "{$record->plan_name} (₹{$record->price})")
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
            ->emptyStateHeading('No packages include this test')
            ->emptyStateDescription('Attach packages to include this test.')
            ->emptyStateIcon('heroicon-o-rectangle-stack');
    }
}

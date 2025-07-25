<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Payment;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('User Information')
                    ->schema([
                        Infolists\Components\Split::make([
                            Infolists\Components\Grid::make(2)
                                ->schema([
                                    Infolists\Components\Group::make([
                                        Infolists\Components\TextEntry::make('full_name')
                                            ->label('Full Name')
                                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                                            ->weight(FontWeight::Bold),
                                        Infolists\Components\TextEntry::make('email')
                                            ->label('Email Address')
                                            ->icon('heroicon-m-envelope')
                                            ->copyable()
                                            ->copyMessage('Email copied'),
                                        Infolists\Components\TextEntry::make('phone')
                                            ->label('Phone Number')
                                            ->icon('heroicon-m-phone')
                                            ->placeholder('Not provided'),
                                    ]),
                                    Infolists\Components\Group::make([
                                        Infolists\Components\TextEntry::make('user_type')
                                            ->label('User Type')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'ADMIN' => 'success',
                                                'USER' => 'primary',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('status')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'ACTIVE' => 'success',
                                                'INACTIVE' => 'danger',
                                                'SUSPENDED' => 'warning',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('created_at')
                                            ->label('Joined Date')
                                            ->dateTime()
                                            ->since(),
                                    ]),
                                ]),
                        ]),
                    ])
                    ->columns(1),

                Infolists\Components\Section::make('Account Statistics')
                    ->schema([
                        Infolists\Components\Split::make([
                            Infolists\Components\Grid::make(4)
                                ->schema([
                                    Infolists\Components\TextEntry::make('payments_count')
                                        ->label('Total Payments')
                                        ->state(fn ($record) => $record->payments()->count())
                                        ->badge()
                                        ->color('info'),
                                    Infolists\Components\TextEntry::make('successful_payments_count')
                                        ->label('Successful Payments')
                                        ->state(fn ($record) => $record->successfulPayments()->count())
                                        ->badge()
                                        ->color('success'),
                                    Infolists\Components\TextEntry::make('total_spent')
                                        ->label('Total Spent')
                                        ->state(fn ($record) => '₹' . number_format($record->successfulPayments()->sum('amount'), 2))
                                        ->badge()
                                        ->color('warning'),
                                    Infolists\Components\TextEntry::make('active_packages_count')
                                        ->label('Active Packages')
                                        ->state(fn ($record) => $record->activePackages()->count())
                                        ->badge()
                                        ->color('primary'),
                                ]),
                        ]),
                    ])
                    ->columns(1),
            ]);
    }

    protected function getFooterWidgets(): array
    {
        return [
            UserResource\Widgets\UserPaymentsWidget::make([
                'record' => $this->getRecord(),
            ]),
        ];
    }
}

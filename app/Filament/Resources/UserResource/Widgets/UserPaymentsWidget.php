<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Payment;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class UserPaymentsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public ?User $record = null;

    protected function getTableHeading(): string
    {
        if (!$this->record) {
            return 'Payment History';
        }

        $paymentCount = $this->record->payments()->count();
        return "Payment History ({$paymentCount} payments)";
    }

    protected function getTableQuery(): Builder
    {
        // If no record is set, return empty query
        if (!$this->record) {
            return Payment::query()->whereRaw('1 = 0'); // Returns empty result set
        }

        return Payment::query()
            ->where('user_id', $this->record->id)
            ->with(['package'])
            ->latest();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_id')
                    ->label('Payment ID')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Payment ID copied')
                    ->limit(25)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 25 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('package_name')
                    ->label('Package')
                    ->searchable()
                    ->description(fn (Payment $record): string => 
                        $record->package ? "ID: {$record->package->id}" : 'Package deleted'
                    ),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('INR')
                    ->sortable()
                    ->description(fn (Payment $record): ?string => 
                        $record->fee ? 'Fee: ₹' . number_format($record->fee, 2) : null
                    ),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'captured', 'authorized' => 'success',
                        'failed' => 'danger',
                        'pending' => 'warning',
                        'created' => 'info',
                        'refunded' => 'gray',
                        default => 'secondary',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'card' => 'info',
                        'netbanking' => 'success',
                        'upi' => 'warning',
                        'wallet' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\IconColumn::make('international')
                    ->label('International')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Order ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 20 ? $state : null;
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'captured' => 'Captured (Success)',
                        'authorized' => 'Authorized',
                        'failed' => 'Failed',
                        'pending' => 'Pending',
                        'created' => 'Created',
                        'refunded' => 'Refunded',
                    ])
                    ->label('Payment Status'),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'card' => 'Credit/Debit Card',
                        'netbanking' => 'Net Banking',
                        'upi' => 'UPI',
                        'wallet' => 'Digital Wallet',
                        'emi' => 'EMI',
                        'paylater' => 'Pay Later',
                    ])
                    ->label('Payment Method'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_payment')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (Payment $record): string => route('filament.admin.resources.payments.edit', $record)),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->emptyStateHeading('No Payments Found')
            ->emptyStateDescription('This user has not made any payments yet.')
            ->emptyStateIcon('heroicon-o-credit-card');
    }
}

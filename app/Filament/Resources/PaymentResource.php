<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Filament\Resources\PaymentResource\Widgets\PaymentStatsWidget;
use App\Models\Payment;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    
    protected static ?string $navigationLabel = 'Payments';

    protected static ?string $navigationGroup = 'Users & Payments';

    protected static ?string $modelLabel = 'Payment';

    protected static ?string $pluralModelLabel = 'Payments';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->description('Basic payment transaction details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('User'),
                        Forms\Components\Select::make('package_id')
                            ->relationship('package', 'plan_name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Package'),
                        Forms\Components\TextInput::make('payment_id')
                            ->required()
                            ->maxLength(255)
                            ->label('Razorpay Payment ID')
                            ->disabled(fn ($context) => $context !== 'create'),
                        Forms\Components\TextInput::make('order_id')
                            ->required()
                            ->maxLength(255)
                            ->label('Razorpay Order ID')
                            ->disabled(fn ($context) => $context !== 'create'),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('₹')
                            ->label('Amount'),
                        Forms\Components\Select::make('currency')
                            ->required()
                            ->options([
                                'INR' => 'INR (Indian Rupee)',
                                'USD' => 'USD (US Dollar)',
                                'EUR' => 'EUR (Euro)',
                            ])
                            ->default('INR'),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'captured' => 'Captured (Success)',
                                'authorized' => 'Authorized',
                                'failed' => 'Failed',
                                'created' => 'Created',
                                'pending' => 'Pending',
                                'refunded' => 'Refunded',
                            ])
                            ->label('Payment Status'),
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'card' => 'Credit/Debit Card',
                                'netbanking' => 'Net Banking',
                                'upi' => 'UPI',
                                'wallet' => 'Digital Wallet',
                                'emi' => 'EMI',
                                'paylater' => 'Pay Later',
                            ])
                            ->label('Payment Method'),
                    ]),

                Forms\Components\Section::make('Additional Details')
                    ->description('Additional payment and customer information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('package_name')
                            ->required()
                            ->maxLength(255)
                            ->label('Package Name (at purchase)')
                            ->disabled(fn ($context) => $context !== 'create'),
                        Forms\Components\TextInput::make('fee')
                            ->numeric()
                            ->prefix('₹')
                            ->label('Processing Fee'),
                        Forms\Components\TextInput::make('contact')
                            ->maxLength(255)
                            ->label('Customer Contact'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255)
                            ->label('Customer Email'),
                        Forms\Components\TextInput::make('card_id')
                            ->maxLength(255)
                            ->label('Card ID'),
                        Forms\Components\Toggle::make('international')
                            ->label('International Payment'),
                        Forms\Components\DateTimePicker::make('payment_created_at')
                            ->label('Payment Created At (Razorpay)'),
                    ]),

                Forms\Components\Section::make('System Data')
                    ->description('Raw payment response from Razorpay')
                    ->schema([
                        Forms\Components\Textarea::make('payment_response')
                            ->label('Payment Response (JSON)')
                            ->rows(10)
                            ->disabled()
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
                    ->label('Date')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('payment_id')
                    ->searchable()
                    ->label('Payment ID')
                    ->copyable()
                    ->copyMessage('Payment ID copied')
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 20 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Customer')
                    ->description(fn (Payment $record): string => $record->user->email ?? ''),
                Tables\Columns\TextColumn::make('package_name')
                    ->searchable()
                    ->label('Package')
                    ->limit(25)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 25 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('amount')
                    ->money('INR')
                    ->sortable()
                    ->label('Amount')
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
                    ->sortable()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'card' => 'info',
                        'netbanking' => 'success',
                        'upi' => 'warning',
                        'wallet' => 'primary',
                        default => 'gray',
                    })
                    ->searchable()
                    ->label('Method')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\IconColumn::make('international')
                    ->boolean()
                    ->label('Intl')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('contact')
                    ->searchable()
                    ->label('Contact')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order_id')
                    ->searchable()
                    ->label('Order ID')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 20 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('currency')
                    ->badge()
                    ->label('Currency')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment_created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Razorpay Date')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->label('Payment Status')
                    ->placeholder('All Statuses'),
                Tables\Filters\SelectFilter::make('package_id')
                    ->relationship('package', 'plan_name')
                    ->searchable()
                    ->preload()
                    ->label('Package')
                    ->placeholder('All Packages'),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'card' => 'Credit/Debit Card',
                        'netbanking' => 'Net Banking',
                        'upi' => 'UPI',
                        'wallet' => 'Digital Wallet',
                        'emi' => 'EMI',
                        'paylater' => 'Pay Later',
                    ])
                    ->label('Payment Method')
                    ->placeholder('All Methods'),
                Tables\Filters\TernaryFilter::make('international')
                    ->label('International Payments')
                    ->placeholder('All Payments')
                    ->trueLabel('International Only')
                    ->falseLabel('Domestic Only'),
                Tables\Filters\Filter::make('amount_range')
                    ->form([
                        Forms\Components\TextInput::make('amount_from')
                            ->numeric()
                            ->label('Amount From'),
                        Forms\Components\TextInput::make('amount_to')
                            ->numeric()
                            ->label('Amount To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['amount_from'],
                                fn (Builder $query, $amount): Builder => $query->where('amount', '>=', $amount),
                            )
                            ->when(
                                $data['amount_to'],
                                fn (Builder $query, $amount): Builder => $query->where('amount', '<=', $amount),
                            );
                    })
                    ->label('Amount Range'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Date Range'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('view_user')
                        ->label('View User')
                        ->icon('heroicon-o-user')
                        ->color('info')
                        ->url(fn (Payment $record): string => route('filament.admin.resources.users.view', $record->user_id)),
                ])->tooltip('Actions'),
            ])
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->defaultSort('created_at', 'desc')
            ->striped()
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

    public static function getWidgets(): array
    {
        return [
            PaymentStatsWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}

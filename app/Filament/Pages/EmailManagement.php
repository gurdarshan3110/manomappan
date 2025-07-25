<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\EmailService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EmailManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static string $view = 'filament.pages.email-management';

    protected static ?string $navigationGroup = 'Users & Payments';

    protected static ?string $title = 'Email Management';

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Select User')
                    ->options(User::all()->pluck('full_name', 'id'))
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                    
                TextInput::make('subject')
                    ->label('Email Subject')
                    ->placeholder('Enter email subject')
                    ->columnSpanFull(),
                    
                Textarea::make('message')
                    ->label('Custom Message')
                    ->placeholder('Enter custom message (optional)')
                    ->rows(4)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('send_welcome_email')
                ->label('Send Welcome Email')
                ->icon('heroicon-o-paper-airplane')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Send Welcome Email')
                ->modalDescription('Send a welcome email to the selected user.')
                ->action(function () {
                    $userId = $this->data['user_id'] ?? null;
                    
                    if (!$userId) {
                        Notification::make()
                            ->danger()
                            ->title('Error')
                            ->body('Please select a user first.')
                            ->send();
                        return;
                    }

                    $user = User::find($userId);
                    EmailService::sendWelcomeEmail($user);

                    Notification::make()
                        ->success()
                        ->title('Welcome Email Sent')
                        ->body("Welcome email queued for {$user->email}")
                        ->send();
                }),

            Action::make('reset_password')
                ->label('Reset Password')
                ->icon('heroicon-o-key')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Reset User Password')
                ->modalDescription('Generate a new password and send it to the user via email.')
                ->action(function () {
                    $userId = $this->data['user_id'] ?? null;
                    
                    if (!$userId) {
                        Notification::make()
                            ->danger()
                            ->title('Error')
                            ->body('Please select a user first.')
                            ->send();
                        return;
                    }

                    $user = User::find($userId);
                    $password = EmailService::sendPasswordResetEmail($user);

                    Notification::make()
                        ->success()
                        ->title('Password Reset Email Sent')
                        ->body("New password email queued for {$user->email}")
                        ->send();
                }),

            Action::make('create_user_with_password')
                ->label('Create User + Send Password')
                ->icon('heroicon-o-user-plus')
                ->color('primary')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique('users', 'email'),
                ])
                ->action(function (array $data) {
                    $result = EmailService::createUserWithPassword($data);

                    Notification::make()
                        ->success()
                        ->title('User Created Successfully')
                        ->body("User {$result['user']->email} created with auto-generated password. Welcome and password emails queued.")
                        ->send();
                }),
        ];
    }

    public function getEmailStats(): array
    {
        return [
            'total_users' => User::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'unverified_users' => User::whereNull('email_verified_at')->count(),
            'admin_users' => User::where('user_type', User::USER_TYPE_ADMIN)->count(),
            'regular_users' => User::where('user_type', User::USER_TYPE_USER)->count(),
        ];
    }
}

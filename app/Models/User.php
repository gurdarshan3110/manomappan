<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const USER_TYPE_ADMIN = 'ADMIN';
    public const USER_TYPE_USER = 'USER';
    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_SUSPENDED = 'SUSPENDED';
    public const STATUS_INACTIVE = 'INACTIVE';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar_url',
        'phone',
        'user_type',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'full_name',
    ];
    
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->user_type === self::USER_TYPE_ADMIN;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if (!$this->avatar_url) {
            return null;
        }

        if (filter_var($this->avatar_url, FILTER_VALIDATE_URL)) {
            return $this->avatar_url;
        }

        return Storage::url($this->avatar_url);
    }

    public static function getUserTypeList(): array
    {
        return [
            self::USER_TYPE_ADMIN => __('Admin'),
            self::USER_TYPE_USER => __('User'),
        ];
    }

    public static function getStatusList(): array
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }
    
    public function scopeIsAdmin($query)
    {
        return $query->where('user_type', self::USER_TYPE_ADMIN);
    }

    public function scopeIsUser($query)
    {
        return $query->where('user_type', self::USER_TYPE_USER);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeIsInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            $user->name = trim("{$user->first_name} {$user->last_name}");
        });
    }

    /**
     * Get all payments for this user.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all user package relationships.
     */
    public function userHasPackages(): HasMany
    {
        return $this->hasMany(UserHasPackage::class);
    }

    /**
     * Get all packages owned by this user through the pivot table.
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'user_has_packages')
                    ->withPivot('payment_id', 'activated_at', 'expires_at', 'is_active')
                    ->withTimestamps();
    }

    /**
     * Get only active packages for this user.
     */
    public function activePackages(): BelongsToMany
    {
        return $this->packages()->wherePivot('is_active', true);
    }

    /**
     * Check if user has a specific package.
     */
    public function hasPackage(int $packageId): bool
    {
        return $this->activePackages()->where('package_id', $packageId)->exists();
    }

    /**
     * Get successful payments only.
     */
    public function successfulPayments(): HasMany
    {
        return $this->payments()->successful();
    }

    /**
     * Get the user's display name for emails
     */
    public function getEmailDisplayName(): string
    {
        return $this->name ?: $this->full_name ?: $this->email;
    }

    /**
     * Check if user has verified email
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }
}

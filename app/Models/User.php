<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
        'last_login_at',
        'login_count',
        'last_login_ip',
        'last_activity_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];


    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class);
    // }

    // public function payments(): HasMany
    // {
    //     return $this->hasMany(Payment::class);
    // }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['admin', 'author']);
    }
}

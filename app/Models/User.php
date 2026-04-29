<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'email', 'password', 'rating'])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $casts = [
        'premium_expires_at' => 'datetime',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
       return $this->is_admin == true;
       /* return true;*/
    }


    //уровни
    public function getLevel()
    {
        if ($this->rating < 500) {
            return 'Junior';
        }

        if ($this->rating < 1500) {
            return 'Middle';
        }

        return 'Senior';
    }


    public function isPremiumActive(): bool
    {
        // Если флаг уже false – доступа нет
        if (!$this->is_premium) {
            return false;
        }

        // Если дата истечения не задана (бессрочный доступ) – доступ есть
        if ($this->premium_expires_at === null) {
            return true;
        }

        // Если срок истёк – сбрасываем флаг и сохраняем
        if ($this->premium_expires_at->isPast()) {
            $this->is_premium = false;
            $this->save();
            return false;
        }

        return true;
    }

}



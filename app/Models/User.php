<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

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

    // Relation btw models

    public function experienceLevel(): HasOne
    {
        return $this->hasOne(
            ExperienceLevels::class,
            'id',
            'experience_level_id'
        );
    }

    public function familyStatus(): HasOne
    {
        return $this->hasOne(FamilyStatus::class, 'id', 'family_status_id');
    }

    public function nationality(): HasOne
    {
        return $this->hasOne(Nationality::class, 'id', 'nationality_id');
    }

    public function position(): HasOne
    {
        return $this->hasOne(Position::class, 'id', 'postion_id');
    }

    public function contracts(): HasOne
    {
        return $this->hasOne(COntracts::class, 'id', 'contract_id');
    }
    public function leaves(): HasMany
    {
        return $this->hasMany(Leaves::class, 'leave_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $name = $this->name . ' ' . $this->lastName;
        $this->notify(new ResetPassword($name, $token));
    }
}

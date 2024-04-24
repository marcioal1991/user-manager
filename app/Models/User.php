<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\EloquentBuilder\UserEloquentBuilder;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * 
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $mobile
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property string $email
 * @property string $username
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool $superadmin
 * @property \Illuminate\Support\Carbon|null $last_logged_in
 * @property \Illuminate\Support\Carbon|null $last_action_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PasswordResetToken|null $passwordResetToken
 * @method static UserEloquentBuilder|User active()
 * @method static UserEloquentBuilder|User createdInLastIn(\Carbon\Carbon $date)
 * @method static UserEloquentBuilder|User deletedInLastIn(\Carbon\Carbon $date)
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static UserEloquentBuilder|User inactive(\Carbon\Carbon $date)
 * @method static UserEloquentBuilder|User newModelQuery()
 * @method static UserEloquentBuilder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static UserEloquentBuilder|User query()
 * @method static UserEloquentBuilder|User whereCreatedAt($value)
 * @method static UserEloquentBuilder|User whereDateOfBirth($value)
 * @method static UserEloquentBuilder|User whereDeletedAt($value)
 * @method static UserEloquentBuilder|User whereEmail($value)
 * @method static UserEloquentBuilder|User whereEmailVerifiedAt($value)
 * @method static UserEloquentBuilder|User whereFirstName($value)
 * @method static UserEloquentBuilder|User whereLastActionAt($value)
 * @method static UserEloquentBuilder|User whereLastLoggedIn($value)
 * @method static UserEloquentBuilder|User whereLastName($value)
 * @method static UserEloquentBuilder|User whereMobile($value)
 * @method static UserEloquentBuilder|User wherePassword($value)
 * @method static UserEloquentBuilder|User whereSuperadmin($value)
 * @method static UserEloquentBuilder|User whereUpdatedAt($value)
 * @method static UserEloquentBuilder|User whereUserId($value)
 * @method static UserEloquentBuilder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $connection = 'postgres';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'last_logged_in' => 'datetime',
        'last_action_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->getAttribute('superadmin');
    }


    protected static function newFactory(int $count = null, array $state = []): UserFactory
    {
        return UserFactory::new();
    }
    public function newEloquentBuilder($query): UserEloquentBuilder
    {
        return new UserEloquentBuilder($query);
    }

    public function passwordResetToken(): HasOne
    {
        return $this->hasOne(
            PasswordResetToken::class,
            'email',
            'email',
        );
    }
}

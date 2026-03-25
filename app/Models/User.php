<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'token',
        'must_change_password',
        'status',
        'role',
        'password_changed_at',
        'email_verified_at',
        'last_login_at',
        'blocked_until'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatusEnum::class,
            'role' => UserRoleEnum::class,
        ];
    }
}

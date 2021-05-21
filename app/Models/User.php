<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getIdAttribute(): int
    {
        return $this->attributes['id'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['id'] = $value;
    }

    public function getUsernameAttribute(): string
    {
        return $this->attributes['username'];
    }

    public function setUsernameAttribute(string $value): void
    {
        $this->attributes['username'] = $value;
    }
}

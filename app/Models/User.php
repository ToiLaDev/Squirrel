<?php

namespace App\Models;

use App\Traits\CausesActivityTrait;
use App\Traits\LogActivityTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Traits\ExtendTrait as ExtendTrait;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * Class User
 * @package App\Models
 * @method static findEmail($email) Add a basic where clause to the query.
 */

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, Notifiable, CanResetPassword, MustVerifyEmail, HasApiTokens, ExtendTrait, HasRoles, LogActivityTrait, CausesActivityTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'id_number',
        'password',
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'status',
        'avatar',
        'type',
        'referral'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'id_verified_at' => 'datetime'
    ];

    protected $appends = ['avatar', 'full_name'];

    public function scopeFindEmail(EloquentBuilder $query, $email) {
        return $query->where('email' ,$email)->firstOrFail();
    }

    public function getFullNameAttribute()
    {
        return __(':first_name :last_name', ['first_name' => $this->first_name, 'last_name' => $this->last_name]);
    }

    public function getAvatarAttribute($value)
    {
        return empty($value)?"https://ui-avatars.com/api/?bold=1&color=076FD6&background=EEEEEE&name={$this->full_name}":Storage::url($value);
    }
}

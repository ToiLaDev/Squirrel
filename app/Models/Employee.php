<?php

namespace App\Models;

use App\Notifications\Admin\ResetPasswordNotification;
use App\Traits\CausesActivityTrait;
use App\Traits\ExtendTrait;
use App\Traits\LogActivityTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use SoftDeletes, CanResetPassword, HasFactory, Notifiable, HasRoles, ExtendTrait, LogActivityTrait, CausesActivityTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'status',
        'avatar'
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
        'email_verified_at' => 'datetime'
    ];

    protected $appends = ['full_name'];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getFullnameAttribute()
    {
        return __(':first_name :last_name', ['first_name' => $this->first_name, 'last_name' => $this->last_name]);
    }

    public function getAvatarAttribute($value)
    {
        return empty($value)?"https://ui-avatars.com/api/?bold=1&color=076FD6&background=EEEEEE&name={$this->full_name}":Storage::url($value);
    }
}

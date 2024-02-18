<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
        'company_id',
    ];

    protected $hidden = [
        'username',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getPermissions(){
        return $this->role->permissions->pluck('name')->toArray();
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}

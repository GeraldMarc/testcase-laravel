<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'permission_id',
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];

    public function users()
	{
	  return $this->belongsToMany(User::class, 'role_id', 'id');
    }

    public function permissions()
	{
	  return $this->belongsToMany(Permission::class, 'role_permission', 'role_id');
    }
}

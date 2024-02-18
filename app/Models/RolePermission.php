<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];

    // public function roles()
	// {
	//   return $this->belongsToMany(Role::class, $this->getTable(), 'role_id', 'id');
    // }
    // public function permissions()
	// {
	//   return $this->belongsToMany(Permission::class, $this->getTable(), 'permission_id','id');
    // }
}

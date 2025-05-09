<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class,'created_by');
    }

    public function role()
    { 
        // Assuming admin has a one-to-many relationship with Role
        return $this->belongsTo(Role::class);
    }

    // Assuming admin is related to Role through a pivot table 'role_permssions'
    public function rolePermissions()
    { 
        // Admin now has a many-to-many relationship with Permission through the 'role_permssions' table
        return $this->belongsToMany(Permission::class, 'role_permssions', 'admin_id', 'permission_id')
                    ->withTimestamps();
    }

    // Check if Admin has a certain permission
    public function hasPermission($permission)
    { 
        if ($this->isAdmin()) { 
            return true; 
        } 

        // Check if the admin has the requested permission through the role_permssions table
        return $this->rolePermissions()->where('permission', $permission)->exists();
    }

    // Assuming isAdmin checks if this admin is a super admin
    public function isAdmin()
    { 
        return $this->role()->where('id', 1)->exists(); // assuming 1 is the super_admin role_id
    }
}
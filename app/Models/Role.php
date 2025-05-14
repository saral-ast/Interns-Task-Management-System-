<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;
    
    public function permissions() {
        
        return $this->belongsToMany(Permission::class, 'role_permssions');
    }
    
    /**
     * Get all admins with this role
     */
    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }
    
    /**
     * Get all users with this role
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    /**
     * Get permission IDs for this role
     */
    public function getPermissionIds(): array
    {
        return $this->permissions()->pluck('permissions.id')->toArray();
    }
}
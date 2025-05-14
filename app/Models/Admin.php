<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $guarded = [];
    
    // Property to store loaded permissions
    protected $permissionsLoaded = false;
    protected $loadedPermissions = [];
    
    // Always eager load these relationships
    protected $with = ['role'];

    public function tasks()
    {
        return $this->hasMany(Task::class,'created_by');
    }

    public function role()
    { 
        return $this->belongsTo(Role::class)->withDefault(['id' => 0, 'name' => 'none']);
    }

    // Relationship to permissions through role_permssions
    public function rolePermissions()
    { 
        return $this->belongsToMany(Permission::class, 'role_permssions', 'admin_id', 'permission_id')
                    ->withTimestamps();
    }

    // Check if Admin has a certain permission
    public function hasPermission($permission)
    { 
        // Super admin check
        if ($this->isAdmin()) { 
            return true; 
        }
        
        // Load all permissions at once if not loaded yet
        if (!$this->permissionsLoaded) {
            $this->loadAllPermissions();
        }
        
        // Check if permission exists in the loaded array
        return in_array($permission, $this->loadedPermissions);
    }
    
    // Load all permissions at once
    public function loadAllPermissions()
    {
        $this->loadedPermissions = $this->rolePermissions()
            ->pluck('permission')
            ->toArray();
        $this->permissionsLoaded = true;
    }

    // Check if Admin is a super admin (id=1)
    public function isAdmin()
    { 
        // Use eager loaded role if available
        if ($this->relationLoaded('role')) {
            return $this->role->id === 1;
        }
        
        // Otherwise query the database
        return $this->role()->where('id', 1)->exists();
    }
}
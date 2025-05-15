<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $guarded = [];
    
    // Property to store loaded permissions
    protected $permissionsLoaded = false;
    protected $loadedPermissions = [];

     protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function hidden(){
        return ['password'];
    }
    
    // Eager load role by default
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
        // Super admin check - use the loaded role relation
        if ($this->isAdmin()) { 
            return true; 
        }
        
        // Load all permissions at once if not loaded yet - reduces database roundtrips
        if (!$this->permissionsLoaded) {
            $this->loadAllPermissions();
        }
        
        // Check if permission exists in the loaded array
        return in_array($permission, $this->loadedPermissions);
    }
    
    // Load all permissions at once using the model relationship
    public function loadAllPermissions()
    {
        // Use the Eloquent relationship instead of direct DB query
        $permissions = $this->rolePermissions()->pluck('permission')->toArray();
            
        $this->loadedPermissions = $permissions;
        $this->permissionsLoaded = true;
        
        return $this;
    }

    // Check if Admin is a super admin (id=1)
    public function isAdmin()
    { 
        // Always use eager loaded role if available to avoid database query
        if ($this->relationLoaded('role')) {
            return $this->role->id === 1;
        }
        
        // If role is not loaded, load it and check
        $this->load('role');
        return $this->role->id === 1;
    }
}
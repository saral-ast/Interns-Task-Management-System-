<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;
    protected $guarded = [];


    public function role()
    { 
        return $this->belongsTo(Role::class, 'role_id'); 
    } 

    public function isAdmin()
    { 
        return $this->role->name === 'super_admin';
    } 

    public function hasPermission($permission)
    { 
        if ($this->isAdmin()) { 
            return true; 
        } 

        // Check if the admin's role has the requested permission 
        if($this->role) { 
            return $this->role->whereHas('permissions', function ($query) use ($permission) { 
                $query->where('permission', $permission); 
            })->exists(); 
        } 
        
        return false; 
    }
}
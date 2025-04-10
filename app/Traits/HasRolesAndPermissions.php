<?php 
namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRolesAndPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'user_permissions');
    }

    public function hasRole(...$roles)
    {
        foreach($roles as $role){
            if($this->roles->contains('slug',$role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug',$permission)->count();
    }


    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role){
            if($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionsTo($permission)
    {
        return $this->hasPermission($permission->slug) || $this->hasPermissionThroughRole($permission);
    }



}
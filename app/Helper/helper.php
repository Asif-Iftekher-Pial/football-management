<?php

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

if (!function_exists('roleCheck')) {
    function roleCheck($auth_user_id) {
        

        $user = Auth::user();
        $user_assigned_roles_id = $user->roles->pluck('id')->toArray();


        //check wheather auth_user_id is included in the roles
        if (in_array($auth_user_id, $roles_id)) {
            return true;
        }else{
            return false;
        }

    }
}


//check if logged in user have all roles or not 
if(!function_exists('haveAllRoles_super_admin')){
    function haveAllRoles_super_admin(){
        $user = Auth::user();
        $auth_user_roles = $user->roles->pluck('id')->toArray(); // getting array of ids of roles of logged in user
        $all_roles = Role::pluck('id')->toArray(); // getting array of all role ids in database

        // Check if all roles in $all_roles are present in $auth_user_roles
        $diff = array_diff($all_roles, $auth_user_roles);

        // If $diff is empty, it means all roles are present in $auth_user_roles
        if(empty($diff)){
            return true;
        }else{
            return false;
        }
   }
}



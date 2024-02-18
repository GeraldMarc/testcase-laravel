<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Company;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = new Role();
        $role->name = 'Manager';
        $role->save();

        $role = new Role();
        $role->name = 'Supervisor';
        $role->save();

        $role = new Role();
        $role->name = 'Staff';
        $role->save();

        $permission = new Permission();
        $permission->name = 'VIEW_COMPANY_USERS';
        $permission->definition = 'View company users';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'MANAGE_COMPANY_USERS';
        $permission->definition = 'Manage company users';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'VIEW_ALL_SUPERVISORS';
        $permission->definition = 'View all supervisors';
        $permission->save();

        $company = new Company();
        $company->name = 'PT.XYZ';
        $company->save();

        $company = new Company();
        $company->name = 'PT.XYZ1';
        $company->save();

        $company = new Company();
        $company->name = 'PT.XYZ2';
        $company->save();

        $role_manager_id = Role::where('name','Manager')->first()->id;
        $role_supervisor_id = Role::where('name','Supervisor')->first()->id;
        $role_staff_id = Role::where('name','Staff')->first()->id;

        $permission_view_company_users_id = Permission::where('name','VIEW_COMPANY_USERS')->first()->id;
        $permission_manage_company_users_id = Permission::where('name','MANAGE_COMPANY_USERS')->first()->id;
        $permission_view_all_supervisors_id = Permission::where('name','VIEW_ALL_SUPERVISORS')->first()->id;
        
        //Manager
        $role_permission = new RolePermission();
        $role_permission->role_id = $role_manager_id;
        $role_permission->permission_id = $permission_view_company_users_id;
        $role_permission->save();

        $role_permission = new RolePermission();
        $role_permission->role_id = $role_manager_id;
        $role_permission->permission_id = $permission_manage_company_users_id;
        $role_permission->save();

        $role_permission = new RolePermission();
        $role_permission->role_id = $role_manager_id;
        $role_permission->permission_id = $permission_view_all_supervisors_id;
        $role_permission->save();

        //Supervisor
        $role_permission = new RolePermission();
        $role_permission->role_id = $role_supervisor_id;
        $role_permission->permission_id = $permission_view_company_users_id;
        $role_permission->save();

        $role_permission = new RolePermission();
        $role_permission->role_id = $role_supervisor_id;
        $role_permission->permission_id = $permission_manage_company_users_id;
        $role_permission->save();

        //Staff
        $role_permission = new RolePermission();
        $role_permission->role_id = $role_supervisor_id;
        $role_permission->permission_id = $permission_view_company_users_id;
        $role_permission->save();

        $company_xyz_id = Company::where('name','PT.XYZ')->first()->id;
        $company_xyz1_id = Company::where('name','PT.XYZ1')->first()->id;
        $company_xyz2_id = Company::where('name','PT.XYZ2')->first()->id;

        //PT XYZ
        User::factory(2)->create([
            'role_id' => $role_manager_id,
            'company_id' => $company_xyz_id,
        ]);

        User::factory(3)->create([
            'role_id' => $role_supervisor_id,
            'company_id' => $company_xyz_id,
        ]);

        User::factory(10)->create([
            'role_id' => $role_staff_id,
            'company_id' => $company_xyz_id,
        ]);

        //PT XYZ1
        User::factory(1)->create([
            'role_id' => $role_manager_id,
            'company_id' => $company_xyz1_id,
        ]);

        User::factory(2)->create([
            'role_id' => $role_supervisor_id,
            'company_id' => $company_xyz1_id,
        ]);

        User::factory(6)->create([
            'role_id' => $role_staff_id,
            'company_id' => $company_xyz1_id,
        ]);

        //PT XYZ2
        User::factory(1)->create([
            'role_id' => $role_manager_id,
            'company_id' => $company_xyz2_id,
        ]);

        User::factory(4)->create([
            'role_id' => $role_supervisor_id,
            'company_id' => $company_xyz2_id,
        ]);

        User::factory(8)->create([
            'role_id' => $role_staff_id,
            'company_id' => $company_xyz2_id,
        ]);
    }
}

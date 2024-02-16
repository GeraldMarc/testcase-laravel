<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Company;
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

        $company = new Company();
        $company->name = 'PT.XYZ';
        $company->save();

        $company = new Company();
        $company->name = 'PT.XYZ1';
        $company->save();

        $company = new Company();
        $company->name = 'PT.XYZ2';
        $company->save();

        $role_manager = Role::where('name','Manager')->first();
        $role_supervisor = Role::where('name','Supervisor')->first();
        $role_staff = Role::where('name','Staff')->first();

        $company_xyz = Company::where('name','PT.XYZ')->first();
        $company_xyz1 = Company::where('name','PT.XYZ1')->first();
        $company_xyz2 = Company::where('name','PT.XYZ2')->first();

        //PT XYZ
        User::factory(2)->create([
            'role_id' => $role_manager,
            'company_id' => $company_xyz,
        ]);

        User::factory(3)->create([
            'role_id' => $role_supervisor,
            'company_id' => $company_xyz,
        ]);

        User::factory(10)->create([
            'role_id' => $role_staff,
            'company_id' => $company_xyz,
        ]);

        //PT XYZ1
        User::factory(1)->create([
            'role_id' => $role_manager,
            'company_id' => $company_xyz1,
        ]);

        User::factory(2)->create([
            'role_id' => $role_supervisor,
            'company_id' => $company_xyz1,
        ]);

        User::factory(6)->create([
            'role_id' => $role_staff,
            'company_id' => $company_xyz1,
        ]);

        //PT XYZ2
        User::factory(1)->create([
            'role_id' => $role_manager,
            'company_id' => $company_xyz2,
        ]);

        User::factory(4)->create([
            'role_id' => $role_supervisor,
            'company_id' => $company_xyz2,
        ]);

        User::factory(8)->create([
            'role_id' => $role_staff,
            'company_id' => $company_xyz2,
        ]);
    }
}

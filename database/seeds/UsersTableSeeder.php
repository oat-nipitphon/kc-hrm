<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@kc.com',
            'password' => bcrypt('123456'),
        ]);

        $permission=[
            [
            'name' => 'department-create',
            'display_name' => 'Department Create',
            'description' => 'Department Create',
            ],
            [
            'name' => 'department-read',
            'display_name' => 'Department Read',
            'description' => 'Department Read',
            ],
            [
            'name' => 'department-update',
            'display_name' => 'Department Update',
            'description' => 'Department Update',
            ],
            [
            'name' => 'department-delete',
            'display_name' => 'Department Delete',
            'description' => 'Department Delete',
            ]
            ,
            [
            'name' => 'employee-create',
            'display_name' => 'Employee Create',
            'description' => 'Employee Create',
            ],
            [
            'name' => 'employee-read',
            'display_name' => 'Employee Read',
            'description' => 'Employee Read',
            ],
            [
            'name' => 'employee-update',
            'display_name' => 'Employee Update',
            'description' => 'Employee Update',
            ],
            [
            'name' => 'employee-delete',
            'display_name' => 'Employee Delete',
            'description' => 'Employee Delete',
            ],
            [
            'name' => 'admin-create',
            'display_name' => 'Admin Create',
            'description' => 'Admin Create',
            ],
            [
            'name' => 'admin-read',
            'display_name' => 'Admin Read',
            'description' => 'Admin Read',
            ],
            [
            'name' => 'admin-update',
            'display_name' => 'Admin Update',
            'description' => 'Admin Update',
            ],
            [
            'name' => 'admin-delete',
            'display_name' => 'Admin Delete',
            'description' => 'Admin Delete',
            ]
            ];

        $role=[
            [
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin',
            ],
            [
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Manager',
            ],
            [
            'name' => 'head-employee',
            'display_name' => 'Head Employee',
            'description' => 'Head Employee',
            ],
            [
            'name' => 'employee',
            'display_name' => 'Employee',
            'description' => 'Employee',
            ]
            ];
        
        DB::table('permissions')->insert($permission);
        DB::table('roles')->insert($role);

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1',
            'user_type' => 'App\User',
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => '1',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '2',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '3',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '4',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '5',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '6',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '7',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '8',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '9',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '10',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '11',
            'role_id' => '1',
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '12',
            'role_id' => '1',
        ]);
        
    }
}
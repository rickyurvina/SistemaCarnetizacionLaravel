<?php

use App\Models\Student;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Student::class, 100)->create();

        User::truncate();
        Role::truncate();
        DB::table('assigned_roles')->truncate();

        $user=User::create([
            'name'=>'Ricardo Urvina',
            'email'=>'ricky_uc12@hotmail.com',
            'cedula'=>'1721351441',
            'password'=>'12345678'
        ]);
        $role=Role::create([
            'name'=>'admin',
            'display_name'=>'Administrador del sitio',
            'description'=>'descripccion'
        ]);
        $user->roles()->save($role);
    }
}

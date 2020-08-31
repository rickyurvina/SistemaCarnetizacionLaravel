<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UserSeeder::class);
//        $this->call(InstitutionSeeder::class);
//        $this->call(CoursesSeeder::class);
//        $this->call(AreaSeeder::class);
//        $this->call(PersonSeeder::class);
        $this->call(StudentSeeder::class);
    }
}

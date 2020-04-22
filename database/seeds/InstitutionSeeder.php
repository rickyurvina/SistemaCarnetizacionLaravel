<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Institution::class, 500)->create();
    }
}

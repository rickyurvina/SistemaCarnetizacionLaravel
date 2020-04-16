<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mysql_date = '2019-08-19';
        $carbon_date = Carbon::createFromFormat('Y-m-d H:i:s', $mysql_date);
        for ($a=0;$a<50;$a++)
        {
            DB::table('institutions')->insert([
                'INS_NOMBRE'=>'Institucion'.$a,
                'INS_DIRECCION'=>'Direccion'.$a,
                'INS_TELEFONO'=>'026006490'.$a,
                'INS_CELULAR'=>'009565030'.$a,
                'INS_TIPO'=>'Institución Educativa',
                'created_at'=> new \DateTime(),
                'updated_at'=> new \DateTime()
            ]);
        }
    }
}

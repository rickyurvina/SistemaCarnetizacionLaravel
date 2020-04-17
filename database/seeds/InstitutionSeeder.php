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

//        for ($a=0;$a<50;$a++)
//        {
//           DB::table('institutions')->insert([
//               'INS_NOMBRE'=>'Institucion'.$a,
//               'INS_DIRECCION'=>'Direccion'.$a,
//               'INS_TELEFONO'=>'026006490'.$a,
//               'INS_CELULAR'=>'009565030'.$a,
//               'INS_TIPO'=>'Oragnisaciòn'
//           ]);
//        }
    }
}

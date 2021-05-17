<?php

namespace Database\Seeders;

use App\Models\Busqueda;
use Illuminate\Database\Seeder;

class BusquedasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $busca1 = new Busqueda();
        $busca1->marca='jordan';
        $busca1->modelo='max aura 2';
        $busca1->tienda='jdsports';
        $busca1->html='';
        $busca1->save();

        $busca2 = new Busqueda();
        $busca2->marca='nike';
        $busca2->modelo='air max';
        $busca2->html='';
        $busca2->save();

        $busca3 = new Busqueda();
        $busca3->marca='nike';
        $busca3->modelo='air vapormax evo';
        $busca3->html='';
        $busca3->save();

        $busca4 = new Busqueda();
        $busca4->marca='vans';
        $busca4->modelo='old skool';
        $busca4->html='';
        $busca4->save();

        


    }
}

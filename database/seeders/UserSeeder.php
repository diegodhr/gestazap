<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario1 = new User();
        $usuario1->rol_id = 1;
        $usuario1->num_empleado = "000";
        $usuario1->name = "admin";
        $usuario1->email = "dh@mail.com";
        $usuario1->password = md5(123);
        $usuario1->save();

        $usuario2 = new User();
        $usuario2->rol_id = 2;
        $usuario2->num_empleado = "001";
        $usuario2->name = "pepe";
        $usuario2->email = "p@mail.com";
        $usuario2->password = md5(456);
        $usuario2->save();
    }
}

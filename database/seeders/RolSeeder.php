<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

use function PHPUnit\Framework\never;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = new Rol();
        $rol1->tipo = "administrador";
        $rol1->save();
        
        $rol2 = new Rol();
        $rol2->tipo = "usuario";
        $rol2->save();

    }
}

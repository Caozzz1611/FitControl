<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('usuario')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'direccion' => $faker->address,
                'edad' => $faker->numberBetween(15, 40),
                'foto_perfil' => null, // si quieres puedes simular con $faker->imageUrl
                'posicion' => $faker->randomElement(['Delantero', 'Defensa', 'Arquero', 'Mediocampista']),
                'categoria' => $faker->randomElement(['Juvenil', 'Senior', 'Sub-20', 'Sub-17']),
                'documento_identidad' => $faker->unique()->numerify('########'),
                'tel_usu' => $faker->numerify('3#########'),
                'email_usu' => $faker->unique()->safeEmail,
                'contra_usu' => Hash::make('123456'), // todas tendrán la misma clave encriptada
                'rol' => $faker->randomElement(['admin', 'jugador', 'entrenador']),
            ]);
        }
    }
}

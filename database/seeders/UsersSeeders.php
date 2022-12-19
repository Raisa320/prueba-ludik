<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('es_ES');
        for ($i=0; $i < 100; $i++) {
            DB::table('users')->insert(array(
                'name' => $faker->name,
                'lastname'  => $faker->lastname,
                'dni' => $faker->dni(),
                'email' => $faker->safeEmail,
                'password' => $faker->password(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ));
        }
    }
}

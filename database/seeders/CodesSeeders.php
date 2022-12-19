<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CodesSeeders extends Seeder
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
        $users = User::all()->pluck('id');
        for ($i=0; $i < 1000 ; $i++) {
            DB::table('codes')->insert(array(
                'code' => $faker->ean8(),
                'user_id' => $faker->randomElement($users),
                'created_at' => $faker->dateTime()
            ));
        }
    }
}

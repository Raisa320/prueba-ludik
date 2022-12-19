<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeders;
use Database\Seeders\CodesSeeders;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeders::class);
        $this->call(CodesSeeders::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Landing;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Setting::factory()->create();
        User::factory()->create();
        Landing::factory()->create();
    }
}

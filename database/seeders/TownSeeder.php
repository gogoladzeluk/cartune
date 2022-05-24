<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Seeder;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Town::create(['title' => 'თბილისი']);
        Town::create(['title' => 'ქუთაისი']);
        Town::create(['title' => 'გორი']);
    }
}

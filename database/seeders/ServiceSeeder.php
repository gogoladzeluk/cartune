<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create(['title' => 'მატორი']);
        Service::create(['title' => 'შუშები']);
        Service::create(['title' => 'ხუნდები']);
        Service::create(['title' => 'კონდიციონერი']);
    }
}

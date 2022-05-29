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
        Service::create(['title' => 'ძრავის სპეციალისტი']);
        Service::create(['title' => 'გადაცემათა კოლოფის სპეციალისტი']);
        Service::create(['title' => 'დაიკების სისტემის სპეციალისტი']);
        Service::create(['title' => 'მეთუნუქე']);
        Service::create(['title' => 'მღებავი']);
        Service::create(['title' => 'ელექტრო გაყვანილობის სპეციალისტი']);
        Service::create(['title' => 'კალიბრაციის სპეციალისტი']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create(['title' => 'ავლაბარი']);
        District::create(['title' => 'ბაგები']);
        District::create(['title' => 'გლდანი']);
        District::create(['title' => 'ვაკე']);
        District::create(['title' => 'ვარკეთილი']);
        District::create(['title' => 'ზღვისუბანი']);
        District::create(['title' => 'მუხიანი']);
        District::create(['title' => 'ნაძალადევი']);
        District::create(['title' => 'ორთაჭალა']);
        District::create(['title' => 'საბურთალო']);
        District::create(['title' => 'სამგორი']);
        District::create(['title' => 'სანზონა']);
        District::create(['title' => 'ღრმაღელე']);
    }
}

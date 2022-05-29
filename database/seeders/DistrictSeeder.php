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
        District::create(['title' => 'კრწანისი']);
        District::create(['title' => 'ჩუღურეთი']);
        District::create(['title' => 'დიღომი']);
        District::create(['title' => 'გლდანი']);
        District::create(['title' => 'საბურთალო']);
        District::create(['title' => 'დიდუბე']);
        District::create(['title' => 'ვაკე']);
        District::create(['title' => 'ისანი-სამგორი']);
        District::create(['title' => 'ვერა']);
        District::create(['title' => 'მთაწმინდა']);
        District::create(['title' => 'ნაძალადევი']);
        District::create(['title' => 'სანზონა']);
    }
}

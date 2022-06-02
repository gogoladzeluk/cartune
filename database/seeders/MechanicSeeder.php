<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MechanicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'      => 'ლუკა',
            'last_name'       => 'გოგოლაძე',
            'mobile'          => '502912425',
            'profile_picture' => 'mechanic1.jpg',
            'garage_picture'  => 'garage1.jpg',
            'town_id'         => 1,
            'district_id'     => 1,
            'address'         => 'გუდამაყრის 35',
            'password'        => Hash::make('password'),
            'type'            => User::TYPE_MECHANIC,
            'active'          => true,
        ])->services()->attach([1, 2, 3, 4, 5, 6, 7]);

        User::create([
            'first_name'      => 'მიშკა',
            'last_name'       => 'თენიეშვილი',
            'mobile'          => '522121231',
            'profile_picture' => 'mechanic2.png',
            'garage_picture'  => 'garage2.jpg',
            'town_id'         => 1,
            'district_id'     => 3,
            'address'         => 'ვაჯა-ფშაველას 3',
            'password'        => Hash::make('password'),
            'type'            => User::TYPE_MECHANIC,
            'active'          => true,
        ])->services()->attach([1, 4, 7]);

        User::create([
            'first_name'      => 'თომა',
            'last_name'       => 'ფირცხელანი',
            'mobile'          => '555982612',
            'profile_picture' => 'mechanic3.jpg',
            'garage_picture'  => 'garage3.jpg',
            'town_id'         => 1,
            'district_id'     => 3,
            'address'         => 'პოლიტკოვსკაიას 22, ორი ნაბიჯის წინ',
            'password'        => Hash::make('password'),
            'type'            => User::TYPE_MECHANIC,
            'active'          => true,
        ])->services()->attach([1, 5, 6, 7]);

        User::create([
            'first_name'      => 'ვალერი',
            'last_name'       => 'გურგენაშვილი',
            'mobile'          => '558401622',
            'profile_picture' => 'mechanic4.jpg',
            'garage_picture'  => 'garage4.jpeg',
            'town_id'         => 1,
            'district_id'     => 6,
            'address'         => 'ცინცაძის 5, მეორე ჩასახვევი',
            'password'        => Hash::make('password'),
            'type'            => User::TYPE_MECHANIC,
            'active'          => true,
        ])->services()->attach([2, 4, 5]);
    }
}

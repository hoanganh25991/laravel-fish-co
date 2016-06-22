<?php

use App\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Candidate;
use App\Country;
use App\Device;
use App\Store;
use App\Submission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
//        factory(Candidate::class, 10)->create();
//        factory(Country::class, 5)->create();
//        factory("App\\Region", 8)->create();
        factory("App\\Outlet", 23)->create();
//        factory(Device::class, 15)->create();
//        factory("App\\Image", 16)->create();
//        factory(Store::class, 65)->create();
//        factory(Submission::class, 16)->create();
//        factory(Campaign::class, 1)->create();
        Model::reguard();
    }
}

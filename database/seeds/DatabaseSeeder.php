<?php

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
//        factory(Candidate::class, 20)->create();
//        factory(Country::class, 5)->create();
//        factory(Device::class, 30)->create();
//        factory(Store::class, 65)->create();
//        factory(Submission::class, 100)->create();
        Model::reguard();
    }
}

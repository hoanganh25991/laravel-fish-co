<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var Factory $factory */
use Illuminate\Database\Eloquent\Factory;
use App\Candidate;
use App\Country;
use App\Device;
use App\Store;
use App\Submission;

$factory->define(Candidate::class, function (Faker\Generator $faker){
    return [
        Candidate::NAME => $faker->name,
        Candidate::EMAIL => $faker->safeEmail,
        Candidate::CONTACT_NUMBER => $faker->unique()->phoneNumber,
    ];
});

$factory->define(Country::class, function (Faker\Generator $faker){
    $countryNameArray = [
        "Vietnam",
        "Malaysia",
        "Brunei",
        "India",
        "Singapore"
    ];
    return [
        Country::NAME => $faker->unique()->randomElement($countryNameArray)
    ];
});

$factory->define(Device::class, function (Faker\Generator $faker){
    $candidateIdArray = Candidate::lists(Candidate::ID)->toArray();
//    dd($candidateIdArray);
    return [
        Device::SERIAL_NUMBER => $faker->unique()->macAddress,
        Device::DES => $faker->sentences(1, true),
        Device::CANDIDATE_ID => $faker->randomElement($candidateIdArray)
    ];
});

$factory->define(Store::class, function (Faker\Generator $faker){
    $countryIdArray = Country::lists(Country::ID)->toArray();
    return [
        Store::NAME => $faker->name,
        Store::ADDRESS => $faker->address,
        Store::TEL => $faker->phoneNumber,
        Store::COUNTRY_ID => $faker->randomElement($countryIdArray)
    ];
});

$factory->define(Submission::class, function (Faker\Generator $faker){
    $candidateIdArray = Candidate::lists(Candidate::ID)->toArray();
    $countryIdArray = Country::lists(Country::ID)->toArray();
    return [
        Submission::CAPTION => $faker->sentences(1, true),
        Submission::IMAGE_URL => $faker->imageUrl(),
        Submission::CANDIDATE_ID => $faker->randomElement($candidateIdArray),
        Submission::COUNTRY_ID => $faker->randomElement($countryIdArray),
    ];
});

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
use App\Image;
use App\Region;
use Faker\Generator as Faker;
use App\Campaign;
use Illuminate\Database\Eloquent\Factory;
use App\Candidate;
use App\Country;
use App\Device;
use App\Store;
use App\Submission;

$factory->define(Candidate::class, function (Faker $faker){
    return [
        Candidate::NAME => $faker->name,
        Candidate::EMAIL => $faker->safeEmail,
        Candidate::CONTACT_NUMBER => $faker->unique()->phoneNumber,
    ];
});

$factory->define(Country::class, function (Faker $faker){
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

$factory->define(Device::class, function (Faker $faker){
    $candidateIdArray = Candidate::lists(Candidate::ID)->toArray();
//    dd($candidateIdArray);
    return [
        Device::UUID => $faker->unique()->uuid,
        Device::DESCRIPTION => $faker->sentences(1, true),
        Device::CANDIDATE_ID => $faker->randomElement($candidateIdArray)
    ];
});

$factory->define("App\\Region", function (Faker $f){
    $countryIdArray = Country::lists(Country::ID)->toArray();
    return [
        "name" => $f->streetName,
        "country_id" => $f->randomElement($countryIdArray),

        "instagram_url" => $f->imageUrl(),
        "facebook_url" => $f->imageUrl(),
        "twitter_url" => $f->imageUrl(),
        "website_url" => $f->imageUrl(),
    ];
});

$factory->define("App\\Outlet", function (Faker $f){
    $regionIdArray = Region::lists("id")->toArray();
    return [
        "name" => $f->userName,
        "address" => $f->streetName,
        "region_id" => $f->randomElement($regionIdArray),

        "instagram_url" => $f->imageUrl(),
        "facebook_url" => $f->imageUrl(),
        "twitter_url" => $f->imageUrl(),
        "website_url" => $f->imageUrl(),
    ];
});



//$factory->define(Store::class, function (Faker $faker){
//    $countryIdArray = Country::lists(Country::ID)->toArray();
//    return [
//        Store::NAME => $faker->name,
//        Store::ADDRESS => $faker->address,
//        Store::TEL => $faker->phoneNumber,
//        Store::COUNTRY_ID => $faker->randomElement($countryIdArray)
//    ];
//});
$factory->define("App\\Image", function (Faker $f){
    return [
        "name" => $f->sentences(1, true) . ".png",
        "width" => $f->randomNumber(3),
        "height" => $f->randomNumber(3),
        "size" => $f->randomNumber(5),
        "type" => "image/png",
        "path" => md5($f->streetAddress).".png"
    ];
});

$factory->define(Submission::class, function (Faker $faker){
    $candidateIdArray = Candidate::lists(Candidate::ID)->toArray();
    $countryIdArray = Country::lists(Country::ID)->toArray();
    $imageIdArray = Image::lists("id")->toArray();
    return [
        Submission::CANDIDATE_ID => $faker->randomElement($candidateIdArray),
        Submission::COUNTRY_ID => $faker->randomElement($countryIdArray),
        "image_id" => $faker->unique()->randomElement($imageIdArray)
    ];
});

$factory->define(Campaign::class, function (Faker $faker){
    return [
        Campaign::TITLE => $faker->sentences(1, true),
        Campaign::DES => $faker->paragraphs(1, true),
    ];
});
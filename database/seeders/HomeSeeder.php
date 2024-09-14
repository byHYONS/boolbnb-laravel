<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Home::truncate();

        $apartments = config('apartments');

        foreach ($apartments as $new_apartment) {
            $apartment = new Home();

            $apartment->user_id = $new_apartment['id'];
            $apartment->title = $new_apartment['title'];
            $apartment->slug = Str::of($new_apartment['title'])->slug('-');
            $apartment->description = $new_apartment['description'];
            $apartment->beds = $new_apartment['beds'];
            $apartment->bathrooms = $new_apartment['bathrooms'];
            $apartment->rooms = $new_apartment['rooms'];
            $apartment->square_metres = $new_apartment['mq'];
            $apartment->address = $new_apartment['address'];
            $apartment->image = $new_apartment['image'];
            $apartment->lat = $new_apartment['lat'];
            $apartment->long = $new_apartment['long'];

            $apartment->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}

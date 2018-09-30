<?php

use Illuminate\Database\Seeder;
use App\Models\Rooms;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rooms::create(['title' => 'General']);
    }
}

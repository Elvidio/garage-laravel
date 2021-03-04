<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // création de 5 annonces en récupérant le user_id
        Announcement::factory()
            ->count(5)
            ->for(User::all()->random())
            ->create();
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Jobs\NewsJob;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesSeeder::class);
        dispatch(new NewsJob('topstories'));
        dispatch(new NewsJob('newstories'));
        dispatch(new NewsJob('beststories'));
    }
}

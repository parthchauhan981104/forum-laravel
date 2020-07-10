<?php

use Illuminate\Database\Seeder;
use App\Channel;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 7',
            'slug' => Str::slug('Laravel 7', '-')
        ]);

        Channel::create([
            'name' => 'HTML',
            'slug' => Str::slug('HTML', '-')
        ]);

        Channel::create([
            'name' => 'JavaScript',
            'slug' => Str::slug('JavaScript', '-')
        ]);

        Channel::create([
            'name' => 'MySQL',
            'slug' => Str::slug('MySQL', '-')
        ]);
    }
}

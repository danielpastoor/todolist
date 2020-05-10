<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'userID' => '1',
            'category' => 'Fun',
        ]);
        DB::table('settings')->insert([
            'userID' => '1',
            'category' => 'Own Project',
        ]);
        DB::table('settings')->insert([
            'userID' => '1',
            'category' => 'Work',
        ]);
        DB::table('settings')->insert([
            'userID' => '1',
            'category' => 'Project',
        ]);
        DB::table('settings')->insert([
            'userID' => '1',
            'category' => 'School',
        ]);
    }
}

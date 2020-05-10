<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Active tasks
        for ($x = 0; $x <= 4; $x++) {
            DB::table('todo')->insert([
                'userID' => '1',
                'name' => 'Lorem ipsum',
                'category' => 'Project',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium rutrum tristique. Ut volutpat magna non massa laoreet efficitur. Etiam pellentesque ultrices augue',
                'enddate' => date('Y-m-d'),
                'done' => 0,
            ]);
        }
        //Finished Tasks
        for ($x = 0; $x <= 4; $x++) {
            DB::table('todo')->insert([
                'userID' => '1',
                'name' => 'Lorem ipsum',
                'category' => 'Project',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium rutrum tristique. Ut volutpat magna non massa laoreet efficitur. Etiam pellentesque ultrices augue',
                'enddate' => date('Y-m-d'),
                'done' => 1,
            ]);
        }
        //past
        DB::table('todo')->insert([
            'userID' => '1',
            'name' => 'Lorem ipsum',
            'category' => 'Project',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium rutrum tristique. Ut volutpat magna non massa laoreet efficitur. Etiam pellentesque ultrices augue',
            'enddate' => '2016-05-04',
            'done' => 0,
        ]);
        //tomorrow
        DB::table('todo')->insert([
            'userID' => '1',
            'name' => 'Lorem ipsum',
            'category' => 'Project',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium rutrum tristique. Ut volutpat magna non massa laoreet efficitur. Etiam pellentesque ultrices augue',
            'enddate' => date("Y-m-d", strtotime('tomorrow')),
            'done' => 0,
        ]);
        //future
        DB::table('todo')->insert([
            'userID' => '1',
            'name' => 'Lorem ipsum',
            'category' => 'Project',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium rutrum tristique. Ut volutpat magna non massa laoreet efficitur. Etiam pellentesque ultrices augue',
            'enddate' => '2030-05-04',
            'done' => 0,
        ]);
    }
}

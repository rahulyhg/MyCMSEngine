<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();

        DB::table('users')->insert([
        		[
        			'name' => 'Eddie',
        			'email' => 'eddie.power@icloud.com',
        			'password' => bcrypt('secret')
        		],

        		[
        			'name' => 'Mary',
        			'email' => 'mary@eddiesBlog.app',
        			'password' => bcrypt('secret')
        		],
        	]);
    }
}

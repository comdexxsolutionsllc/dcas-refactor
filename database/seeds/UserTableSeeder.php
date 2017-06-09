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
        $f = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            \DB::table('users')->insert([
                'name' => $f->name,
                'email' => $f->unique()->companyEmail,
                'password' => bcrypt('secret'),
                'created_at' => $f->dateTime('now', date_default_timezone_get())
            ]);
        }

    }
}

<?php

use Illuminate\Database\Seeder;
use Modules\internal\Database\Seeds\CategoryTableSeeder;
use Modules\internal\Database\Seeds\TicketTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TicketTableSeeder::class);
    }
}

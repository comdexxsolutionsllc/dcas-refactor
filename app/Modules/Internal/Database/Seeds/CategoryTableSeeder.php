<?php

namespace Modules\internal\Database\Seeds;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = \Faker\Factory::create();

        $categories = [
            "Support",
            "Billing",
            "Marketing",
            "Networking",
            "Sales",
            "Hardware",
            "White Gloves",
            "Infrastructure",
            "Backup",
            "CDN",
            "Telecommunications"
        ];

        for ($i = 0; $i < count($categories); $i++) {
            \DB::table('categories')->insert([
                'name' => $f->randomElements($categories, 1)[0],
                'created_at' => $f->dateTime('now', date_default_timezone_get())
            ]);
        }
    }
}

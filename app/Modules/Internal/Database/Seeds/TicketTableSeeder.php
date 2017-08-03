<?php

namespace Modules\internal\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Internal\Classes\TicketId;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = \Faker\Factory::create();
        $priorities = [
            "High",
            "Normal",
            "Low",
            "In Manager Queue"
        ];

        $statuses = [
            "New",
            "Open",
            "Awaiting Customer Response",
            "On Hold",
            "Escalated",
            "Closed"
        ];

        $user = \App\User::all();
        $category = \Modules\Internal\Models\Category::all();

        for ($i = 0; $i < 100; $i++) {
            \DB::table('tickets')->insert([
                'user_id' => $f->randomElements($user->pluck('id')->toArray(), 1)[0],
                'category_id' => $f->randomElements($category->pluck('id')->toArray(), 1)[0],
                'ticket_id' => TicketId::Generate(),
                'title' => rtrim(substr($f->sentence(), 0, 49), '.'),
                'priority' => $f->randomElements($priorities, 1)[0],
                'message' => $f->paragraph(),
                'status' => $f->randomElements($statuses, 1)[0],
                'created_at' => $f->dateTimeBetween($startDate = '-5 weeks', $endDate = 'now'),
                'updated_at' => $f->dateTimeBetween($startDate = 'now', $endDate = 'now'),
            ]);
        }
    }
}

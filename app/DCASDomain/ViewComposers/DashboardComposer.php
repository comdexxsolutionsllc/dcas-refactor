<?php

namespace DCASDomain\ViewComposers;

use App\ActivityExtend;
use Illuminate\View\View;

class DashboardComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $activities = \Cache::remember('activities', 15, function () {
            return ActivityExtend::users(15)->mostRecent()->get();
        });

        $numberOfUsers = \Cache::remember('numberOfUsers', 10, function () {
            return ActivityExtend::users()->count();
        });

        $numberOfGuests = \Cache::remember('numberOfGuests', 10, function () {
            return ActivityExtend::guests()->count();
        });


        $view->with([
            'activities' => $activities,
            'numberOfUsers' => $numberOfUsers,
            'numberOfGuests' => $numberOfGuests
        ]);
    }
}

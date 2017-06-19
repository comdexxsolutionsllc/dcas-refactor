<?php
use Modules\Internal\Models\Ticket;

Route::group(['module' => 'Internal', 'prefix' => 'api', 'middleware' => ['api'], 'namespace' => 'Modules\Internal\Controllers'], function() {

    Route::get('tickets', function() {
        $tickets = Ticket::with('user')->limit(5)->get();

        return $tickets;
    });

});	

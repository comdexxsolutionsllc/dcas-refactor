<?php

Route::group(['prefix' => 'internal', 'module' => 'Internal', 'middleware' => ['web'], 'namespace' => 'Modules\Internal\Controllers'], function () {
    Route::post('comment', 'CommentsController@postComment');
    Route::get('my_tickets', 'TicketsController@userTickets');
    Route::get('new_ticket', 'TicketsController@create');
    Route::post('new_ticket', 'TicketsController@store');
    Route::get('tickets/{ticket_id}', 'TicketsController@show');

    Route::get('tickets', function() {
        return redirect('/internal/admin/tickets');
    });

    Route::group(['prefix' => 'admin'], function () { //'middleware' => 'admin'
        Route::get('tickets', 'TicketsController@index');
        Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
        Route::post('open_ticket/{ticket_id}', function() {
            return true;
        });
    });

    Route::get('test', 'TicketsController@test');

//    Route::get('/{locale}', function ($locale) {
//        echo trans('validation.required'); // returns 'This is a required field'
//        echo "<br>";
//
//        app()->setLocale('nl');
//
//        echo trans('validation.required'); // returns 'Dit is een verplicht veld'
//    });
});

<?php

Route::group(array('module' => 'Messenger', 'middleware' => ['api'], 'namespace' => 'App\Modules\Messenger\Controllers'), function() {

    Route::resource('Messenger', 'MessengerController');
    
});	

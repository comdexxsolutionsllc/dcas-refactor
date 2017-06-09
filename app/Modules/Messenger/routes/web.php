<?php

Route::group(array('module' => 'Messenger', 'middleware' => ['web'], 'namespace' => 'App\Modules\Messenger\Controllers'), function() {

    Route::resource('Messenger', 'MessengerController');
    
});	

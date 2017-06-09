<?php

Route::group(array('module' => 'Api', 'middleware' => ['web'], 'namespace' => 'App\Modules\Api\Controllers'), function() {

    Route::resource('Api', 'ApiController');
    
});	

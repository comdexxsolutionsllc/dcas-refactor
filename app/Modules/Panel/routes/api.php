<?php

Route::group(array('module' => 'Panel', 'middleware' => ['api'], 'namespace' => 'App\Modules\Panel\Controllers'), function() {

    Route::resource('Panel', 'PanelController');
    
});	

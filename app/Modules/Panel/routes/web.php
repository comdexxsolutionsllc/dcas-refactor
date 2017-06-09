<?php

Route::group(array('module' => 'Panel', 'middleware' => ['web'], 'namespace' => 'App\Modules\Panel\Controllers'), function() {

    Route::resource('Panel', 'PanelController');
    
});	

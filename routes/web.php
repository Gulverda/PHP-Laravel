<?php
    use App\Http\Controllers\PersonController;

    Route::get('/person', [PersonController::class, 'show']);
    
?>
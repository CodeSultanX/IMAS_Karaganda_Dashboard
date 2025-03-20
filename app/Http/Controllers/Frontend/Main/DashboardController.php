<?php 

namespace App\Http\Controllers\Frontend\Main;

use Inertia\Inertia;

class DashboardController{
    public function index(){
        return Inertia::render('Main/Index');

    }

    
}
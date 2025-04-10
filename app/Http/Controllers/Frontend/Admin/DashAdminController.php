<?php 

namespace App\Http\Controllers\Frontend\Admin;

use Inertia\Inertia;

class DashAdminController{

    public function index(){
        return Inertia::render('Admin/Problem/Index');
    }
    public function projects(){
        return Inertia::render('Admin/Project/Index');
    }
    public function tasks(){
        return Inertia::render('Admin/Task/Index');
    }

}
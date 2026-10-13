<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function getCategoryIndex(){
        return view('admin.categories.index');
    }

    public function getRolesIndex(){
        return view('admin.roles.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use \Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    public Authenticatable|User|null $authUser = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = Auth()->user();

            View::share('authUser', $this->authUser);

            return $next($request);
        });
    }
}

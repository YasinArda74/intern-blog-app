<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Routing\Controller as BaseController;
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

    // Return Success Response
    protected function returnSuccessResponse(string $message, ?string $redirectUrl = null, int $statusCode = 200)
    {
        $responseData = [
            'status' => true,
            'message' => trans($message),
        ];

        if (! empty($redirectUrl)) {
            $responseData['redirect'] = $redirectUrl;
        }

        return response()->json($responseData, $statusCode);
    }

    // Return Error Response
    protected function returnErrorResponse(string $message, int $statusCode = 400)
    {
        return response()->json([
            'status' => false,
            'error' => trans($message),
        ], $statusCode);
    }
}

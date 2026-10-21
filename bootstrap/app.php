<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Ana web.php route dosyasını alır. web middleware ile gruplar
            Route::middleware('web')->group(base_path('routes/web.php'));

            // routes/modules ve routes/modules/admin altındaki route dosyalarını web middleware ile gruplar
            $moduleRoutes = glob(base_path('routes/modules/*.php')) ?: [];

            $adminRoutes = glob(base_path('routes/modules/admin/*.php')) ?: [];

            foreach ($moduleRoutes as $moduleRoute) {
                Route::middleware('web')->group($moduleRoute);
            }

            foreach ($adminRoutes as $adminRoute) {
                Route::middleware(['web', 'auth', 'role:admin'])
                    ->prefix('admin')
                    ->as('admin.')
                    ->group($adminRoute);
            }
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            SetLocale::class,
        ]);

        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();

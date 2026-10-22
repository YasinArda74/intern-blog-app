<?php

namespace App\Http\Controllers;

use App\Jobs\ImportPermissionsJob;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        $path = $request->file('file')->store('imports');

        ImportPermissionsJob::dispatch($path, $request->user()->email);

        return back()->with('success', 'Import kuyruğa alındı.');
    }
}

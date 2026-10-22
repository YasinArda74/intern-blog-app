<?php

namespace App\Jobs;

use App\Imports\PermissionsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\PermissionRegistrar;
use App\Mail\PermissionImportReport;
use Illuminate\Support\Facades\Mail;


class ImportPermissionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1;
    public int $timeout = 300;

    public function __construct(
        public string $path,
        public string $email,
    ) {}

    public function handle(): void
    {
        $import = new PermissionsImport();

        Excel::import($import, $this->path, 'local');

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Log::info('Permission import bitti', [
            'created'  => $import->created,
            'existing' => $import->existing,
            'empty'    => $import->empty,
        ]);

        Mail::to($this->email)->send(new PermissionImportReport(
            created: $import->created,
            existing: $import->existing,
            empty: $import->empty,
        ));

        Storage::disk('local')->delete($this->path);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('Permission import hata', ['error' => $e->getMessage()]);

        Mail::to($this->email)->send(new PermissionImportReport(
            created: 0,
            existing: 0,
            empty: 0,
            error: $e->getMessage(),
        ));
    }
}

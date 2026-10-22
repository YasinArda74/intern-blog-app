<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Spatie\Permission\Models\Permission;

class PermissionsImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public int $created = 0;
    public int $existing = 0;
    public int $empty = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $name = trim((string) $row['permission'] ?? $row['name'] ?? $row['permission_name'] ?? '');

            if ($name === '') {
                $this->empty++;
                continue;
            }

            $guard = trim((string) ($row['guard'] ?? $row['guard_name'] ?? '')) ?: 'web';

            $permission = Permission::query()->firstOrCreate([
                'name'       => $name,
                'guard_name' => $guard,
            ]);

            $permission->wasRecentlyCreated ? $this->created++ : $this->existing++;
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }
}

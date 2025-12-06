<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditObserver
{
    /**
     * Helper mencatat aktivitas
     */
    protected function logActivity(Model $model, string $action)
    {
        // Jangan catat jika aksi dari console (Seeder atau Artisan)
        if (!Auth::check() && app()->runningInConsole()) {
            return;
        }

        $userId = Auth::id();

        AuditLog::create([
            'user_id'    => $userId,
            'action'     => $action,
            'table_name' => $model->getTable(),
            'record_id'  => $model->id,
            'description'=> $this->generateDescription($model, $action),
        ]);
    }

    /**
     * Membuat deskripsi log
     */
    protected function generateDescription(Model $model, string $action): string
    {
        return "Aksi '{$action}' pada tabel '{$model->getTable()}' (ID: {$model->id}).";
    }

    /**
     * CREATE (Tambah)
     */
    public function created(Model $model): void
    {
        $this->logActivity($model, 'CREATE');
    }

    /**
     * UPDATE (Edit)
     */
    public function updated(Model $model): void
    {
        // Catat jika ada perubahan field
        if ($model->isDirty()) {
            $this->logActivity($model, 'UPDATE');
        }
    }

    /**
     * DELETE (Hard Delete atau Soft Delete)
     */
    public function deleted(Model $model): void
    {
        // Default: Hard Delete
        $action = 'DELETE';

        if (in_array(\Illuminate\Database\Eloquent\SoftDeletes::class, class_uses($model))
            && !$model->isForceDeleting()) {
            $action = 'SOFT DELETE';
        }

        $this->logActivity($model, $action);
    }

    /**
     * RESTORE (Pulihkan Soft Delete)
     */
    public function restored(Model $model): void
    {
        if (in_array(\Illuminate\Database\Eloquent\SoftDeletes::class, class_uses($model))) {
            $this->logActivity($model, 'RESTORE');
        }
    }
}

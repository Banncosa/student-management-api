<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateApiRoutes extends Command
{
    protected $signature = 'generate:api-routes';

    protected $description = 'Generate API routes file (api.php) with predefined routes';

    public function handle()
    {
        $content = <<<EOD
        <?php
        use App\Http\Controllers\StudentController;
        use App\Http\Controllers\SubjectController;
        use Illuminate\Support\Facades\Route;
        Route::prefix('students')->group(function () {
            // Manage student info
            Route::get('/', [StudentController::class, 'index']);
            Route::post('/', [StudentController::class, 'store']);
            Route::get('/{id}', [StudentController::class, 'show']);
            Route::patch('/{id}', [StudentController::class, 'update']);
            Route::delete('/{id}', [StudentController::class, 'destroy']);
            // Manage student's academic records
            Route::get('/{id}/subjects', [SubjectController::class, 'index']);
            Route::post('/{id}/subjects', [SubjectController::class, 'store']);
            Route::get('/{id}/subjects/{subject_id}', [SubjectController::class, 'show']);
            Route::patch('/{id}/subjects/{subject_id}', [SubjectController::class, 'update']);
        });
        EOD;

        File::put(base_path('routes/api.php'), $content);

        $this->info('API routes file generated successfully.');
    }
}
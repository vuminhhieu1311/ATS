<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\Stage\GetCandidatesByStageAndJobController;
use App\Http\Controllers\WebInitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('stages')->group(function () {
    Route::get('/{stage}/pipelines/{pipeline}/jobs/{jobId}/candidates', GetCandidatesByStageAndJobController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', WebInitController::class);
    Route::resources([
        'jobs' => JobController::class,
        'candidates' => CandidateController::class,
        'pipelines' => PipelineController::class,
    ]);
});

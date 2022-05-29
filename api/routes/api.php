<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\Job\CreateCandidateController;
use App\Http\Controllers\Job\GetAllLocationController;
use App\Http\Controllers\Job\GetAllPublishedJobController;
use App\Http\Controllers\Job\GetPublishedJobController;
use App\Http\Controllers\Job\GetAllTagController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MailTemplate\FillInterviewMailController;
use App\Http\Controllers\MailTemplateController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Stage\GetCandidatesByStageAndJobController;
use App\Http\Controllers\VideoCall\GenerateAgoraToken;
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
Route::resources([
    'resumes' => ResumeController::class,
]);

Route::prefix('jobs')->group(function () {
    Route::get('/published', GetAllPublishedJobController::class);
    Route::get('/published/{job}', GetPublishedJobController::class);
    Route::get('/locations', GetAllLocationController::class);
    Route::get('/tags', GetAllTagController::class);
    Route::post('/{job}/candidates', CreateCandidateController::class);
});

Route::prefix('resumes')->group(function () {
    Route::post('/{resume}/save-content', [ResumeController::class, 'saveContent']);
    Route::get('/{resume}/load-content', [ResumeController::class, 'loadContent']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', WebInitController::class);

    Route::prefix('stages')->group(function () {
        Route::get('/{stage}/pipelines/{pipeline}/jobs/{jobId}/candidates', GetCandidatesByStageAndJobController::class);
    });

    Route::prefix('mail-templates')->group(function () {
        Route::get('{mailTemplate}/interviews/{interview}/fill-interview-mail', FillInterviewMailController::class);
    });

    Route::prefix('video-call')->group(function () {
        Route::post('interviews/{interview}/token', GenerateAgoraToken::class);
    });

//    Route::prefix('jobs')->group(function () {
//        Route::get('/published', GetAllPublishedJobController::class);
//        Route::get('/published/{job}', GetPublishedJobController::class);
//        Route::get('/locations', GetAllLocationController::class);
//        Route::get('/tags', GetAllTagController::class);
//        Route::post('/{job}/candidates', 'CreateCandidateController');
//    });

    Route::resources([
        'jobs' => JobController::class,
        'candidates' => CandidateController::class,
        'pipelines' => PipelineController::class,
        'mail-templates' => MailTemplateController::class,
        'staffs' => StaffController::class,
        'rooms' => RoomController::class,
        'interviews' => InterviewController::class,
    ]);
});

<?php

namespace App\Providers;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use App\Repositories\CandidateJob\CandidateJobRepository;
use App\Repositories\CandidateJob\CandidateJobRepositoryInterface;
use App\Repositories\Interview\InterviewRepository;
use App\Repositories\Interview\InterviewRepositoryInterface;
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\MailTemplate\MailTemplateRepository;
use App\Repositories\MailTemplate\MailTemplateRepositoryInterface;
use App\Repositories\Pipeline\PipelineRepository;
use App\Repositories\Pipeline\PipelineRepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\Staff\StaffRepository;
use App\Repositories\Staff\StaffRepositoryInterface;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JobRepositoryInterface::class, JobRepository::class);
        $this->app->singleton(CandidateRepositoryInterface::class, CandidateRepository::class);
        $this->app->singleton(PipelineRepositoryInterface::class, PipelineRepository::class);
        $this->app->singleton(MailTemplateRepositoryInterface::class, MailTemplateRepository::class);
        $this->app->singleton(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->singleton(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->singleton(CandidateJobRepositoryInterface::class, CandidateJobRepository::class);
        $this->app->singleton(InterviewRepositoryInterface::class, InterviewRepository::class);
        $this->app->singleton(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

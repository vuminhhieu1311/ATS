<?php

namespace App\Providers;

use App\Models\Candidate;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Pipeline;
use App\Models\Stage;
use App\Policies\CandidatePolicy;
use App\Policies\InterviewPolicy;
use App\Policies\JobPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PipelinePolicy;
use App\Policies\StagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Candidate::class => CandidatePolicy::class,
        Pipeline::class => PipelinePolicy::class,
        Stage::class => StagePolicy::class,
        Interview::class => InterviewPolicy::class,
        Job::class => JobPolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

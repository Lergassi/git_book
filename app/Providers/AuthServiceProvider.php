<?php

namespace App\Providers;

use App\Book;
use App\Chapter;
use App\Commit;
use App\Policies\BookPolicy;
use App\Policies\ChapterPolicy;
use App\Policies\CommitPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Book::class => BookPolicy::class,
        Chapter::class => ChapterPolicy::class,
        Commit::class => CommitPolicy::class,
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

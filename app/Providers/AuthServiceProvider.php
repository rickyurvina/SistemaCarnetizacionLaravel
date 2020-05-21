<?php

namespace App\Providers;
use App\Models\Person;
use App\Models\Picture;
use App\Models\Student;
use App\Policies\PhotoPolicy;
use App\Policies\PicturePolicy;
use App\Policies\StudentPolicy;
use App\Policies\UsuarioPolicy;
use App\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Student::class =>StudentPolicy::class,
        Picture::class=>PicturePolicy::class,
        Person::class=>UsuarioPolicy::class,
        Photo::class=>PhotoPolicy::class
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

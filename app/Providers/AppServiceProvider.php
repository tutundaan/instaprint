<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Role::observe(\App\Observers\RoleObserver::class);
        \App\User::observe(\App\Observers\UserObserver::class);
        \App\Employee::observe(\App\Observers\EmployeeObserver::class);
        \App\Attendance::observe(\App\Observers\AttendanceObserver::class);
        \App\AttendanceCounter::observe(\App\Observers\AttendanceCounterObserver::class);
    }
}

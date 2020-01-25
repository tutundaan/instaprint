<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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
        \App\Rating::observe(\App\Observers\RatingObserver::class);
        \App\Attendance::observe(\App\Observers\AttendanceObserver::class);
        \App\Recomendation::observe(\App\Observers\RecomendationObserver::class);
        \App\AttendanceCounter::observe(\App\Observers\AttendanceCounterObserver::class);

        Str::macro('formatRupiah', function($value) {
            return 'Rp. '. number_format($value) . ',-';
        });

        View::composer('auth.failure._employees', function ($view) {
            $employees = \App\Employee::orderBy('name')->get();

            $view->with('employees', $employees);
        });

        View::composer('auth.failure._filter', function ($view) {
            $holders = \App\Failure::distinct()->get('holder');
            $employees = \App\Employee::orderBy('name')->get();

            $view->with('failureHolder', $holders)
                ->with('pristineEmployees', $employees);
        });
    }
}

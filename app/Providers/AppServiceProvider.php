<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Task\TaskInterface;
use App\Repositories\Task\TaskRepository;
use Blade;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Blade::directive('toastr', function ($expression){
            return "<script>
                    toastr.{{ Session::get('alert-type') }}($expression)
                 </script>";
        });
    }
}

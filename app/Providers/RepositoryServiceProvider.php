<?php

namespace App\Providers;


use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Repository\Services\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Sections\SectionRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //admin
       $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
       $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

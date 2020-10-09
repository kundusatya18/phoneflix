<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;
use App\Contracts\BannerContract;
use App\Repositories\BannerRepository;
use App\Contracts\AdminContract;
use App\Repositories\AdminRepository;
use App\Contracts\GenreContract;
use App\Repositories\GenreRepository;
use App\Contracts\LanguageContract;
use App\Repositories\LanguageRepository;
use App\Contracts\ShowContract;
use App\Contracts\TrailerContract;
use App\Repositories\ShowRepository;
use App\Repositories\TrailerRepository;
use App\Contracts\UserContract;
use App\Repositories\UserRepository;
use App\Contracts\PackageContract;
use App\Repositories\PackageRepository;
use App\Contracts\WebseriesContract;
use App\Repositories\WebseriesRepository;
use App\Contracts\EpisodeContract;
use App\Repositories\EpisodeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AdminContract::class        =>  AdminRepository::class,
        CategoryContract::class     =>  CategoryRepository::class,
        BannerContract::class       =>  BannerRepository::class,
        GenreContract::class        =>  GenreRepository::class,
        LanguageContract::class     =>  LanguageRepository::class,
        ShowContract::class         =>  ShowRepository::class,
        PackageContract::class         =>  PackageRepository::class,
        UserContract::class  =>  UserRepository::class,
        TrailerContract::class  =>  TrailerRepository::class,
        WebseriesContract::class  =>  WebseriesRepository::class,
        EpisodeContract::class  =>  EpisodeRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
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

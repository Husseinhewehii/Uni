<?php
//
//namespace App\Providers;
//
//use App\repository\EloquentRepositoryInterface;
//use App\repository\UserRepositoryInterface;
//use App\repository\eloquent\UserRepository;
//use App\repository\eloquent\BaseRepository;
//use Faker\Provider\Base;
//use Illuminate\Support\ServiceProvider;
//
//
///**
// * Class RepositoryServiceProvider
// * @package App\Providers
// */
//class RepositoryServiceProvider extends ServiceProvider
//{
//    /**
//     * Register services.
//     *
//     * @return void
//     */
//    public function register()
//    {
//        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
//        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
//    }
//
//    /**
//     * Bootstrap services.
//     *
//     * @return void
//     */
//    public function boot()
//    {
//        //
//    }
//}

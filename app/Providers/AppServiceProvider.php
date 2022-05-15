<?php
namespace App\Providers;
use App\Repositories\ClassRepository\ClassRepository;
use App\Repositories\ClassRepository\ClassRepositoryInterface;
use App\Repositories\Mark\MarkRepository;
use App\Repositories\Mark\MarkRepositoryInterface;
use App\Repositories\Faculty\FacultyRepository;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        $this->app->singleton(ClassRepositoryInterface::class,ClassRepository::class);
        $this->app->singleton(FacultyRepositoryInterface::class,FacultyRepository::class);
        $this->app->singleton(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->singleton(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->singleton(MarkRepositoryInterface::class,MarkRepository::class);
        $this->app->singleton(UserRepositoryInterface::class,UserRepository::class);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        URL::forceScheme('https');
//        Blade::withoutDoubleEncoding();
        Schema::defaultStringLength(191);
    }
}
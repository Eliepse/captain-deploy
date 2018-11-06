<?php

namespace App\Providers;

use App\Project;
use App\ProjectConfig;
use Eliepse\Deployer\Deployer;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class DeployerServiceProvider extends ServiceProvider
{

    protected $deployer;


    public function boot()
    {
        $this->deployer = new Deployer();

        $this->deployer->setProjectsPath(base_path("projects/"));
        $this->deployer->setTasksPath(resource_path("tasks/"));
        $this->deployer->setProjectClass(Project::class);
        $this->deployer->setConfigClass(ProjectConfig::class);

        $this->deployer->setLogger(app(LoggerInterface::class));
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Deployer::class, function () {
            return $this->deployer;
        });
    }
}

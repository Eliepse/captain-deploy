<?php

namespace App\Console;

use App\Console\Command\CreateProjectCommand;
use App\Console\Command\CreateTaskCommand;
use App\Console\Command\DeployProjectCommand;
use App\Console\Command\DestroyProjectCommand;
use App\Console\Command\InitProjectCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CreateProjectCommand::class,
        CreateTaskCommand::class,
        DeployProjectCommand::class,
        DestroyProjectCommand::class,
        InitProjectCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}

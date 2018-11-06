<?php


namespace App\Console\Command;

use Eliepse\Deployer\Deployer;
use Illuminate\Console\Command;

class ListProjectsCommand extends Command
{
    /**
     * @var Deployer
     */
    protected $deployer;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

}
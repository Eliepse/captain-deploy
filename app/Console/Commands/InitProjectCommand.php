<?php


namespace App\Console\Command;

use Eliepse\Deployer\Command\InitProjectCommand as InitProjectCommandBase;
use Eliepse\Deployer\Deployer;

class InitProjectCommand extends InitProjectCommandBase
{

    public function __construct(?string $name = null, Deployer $deployer = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

}
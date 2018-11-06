<?php


namespace App\Console\Command;

use Eliepse\Deployer\Command\DeployProjectCommand as DeployProjectCommandBase;
use Eliepse\Deployer\Deployer;

class DeployProjectCommand extends DeployProjectCommandBase
{

    public function __construct(?string $name = null, Deployer $deployer = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

}
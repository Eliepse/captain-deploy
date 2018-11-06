<?php


namespace App\Console\Command;

use Eliepse\Deployer\Command\DestroyProjectCommand as DestroyProjectCommandBase;
use Eliepse\Deployer\Deployer;

class DestroyProjectCommand extends DestroyProjectCommandBase
{

    public function __construct(?string $name = null, Deployer $deployer = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

}
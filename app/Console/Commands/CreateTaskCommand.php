<?php


namespace App\Console\Command;

use Eliepse\Deployer\Command\CreateTaskCommand as CreateTaskCommandBase;
use Eliepse\Deployer\Deployer;

class CreateTaskCommand extends CreateTaskCommandBase
{

    public function __construct(?string $name = null, Deployer $deployer = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

}
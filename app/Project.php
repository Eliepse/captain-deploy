<?php

namespace App;


use Eliepse\Deployer\Deployer;

class Project extends \Eliepse\Deployer\Project\Project
{

    public function __construct(string $name, ProjectConfig $config, Deployer $deployer)
    {
        parent::__construct($name, $config, $deployer);
    }

    public function getRepository(): string
    {
        return $this->config->get("repository");
    }

    public function getProvider(): string
    {
        return $this->config->get("provider");
    }

    public function getHookKey()
    {
        return $this->config->get("hook_key");
    }

}
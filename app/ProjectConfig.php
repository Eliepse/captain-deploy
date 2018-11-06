<?php

namespace App;


use Eliepse\Deployer\Config\Config;

class ProjectConfig extends Config
{
    protected $required = ["deploy_path", "git_url", "provider", "hook_key"];
}
<?php

namespace App\Jobs;

use App\Project;
use Eliepse\Deployer\Deployer;

class DeployProjectJob extends Job
{

    /**
     * @var string
     */
    protected $project;

    /**
     * Create a new job instance.
     *
     * @param string $projectName
     */
    public function __construct(string $projectName)
    {
        $this->project = $projectName;
    }

    /**
     * Execute the job.
     *
     * @param Deployer $deployer
     * @return void
     * @throws \Eliepse\Deployer\Exception\CompileException
     * @throws \Eliepse\Deployer\Exception\ProjectException
     * @throws \Eliepse\Deployer\Exception\ReleaseFailedException
     * @throws \Eliepse\Deployer\Exception\TaskNotFoundException
     * @throws \Eliepse\Deployer\Exception\TaskRunFailedException
     */
    public function handle(Deployer $deployer)
    {
        /** @var Project $project */
        $project = $deployer->getProject($this->project);

        if ($this->project)
            $project->deploy();
    }
}

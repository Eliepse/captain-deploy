<?php

namespace App\Http\Controllers;

use App\Jobs\DeployProjectJob;
use App\Project;
use Eliepse\Deployer\Deployer;
use Eliepse\Deployer\Exception\ConfigurationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class DeployController extends Controller
{

    protected $projects = [];


    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->loadProjects();
    }


    /**
     * @param Request $request
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deploy(Request $request, string $key)
    {
        $project = $this->findProjectFromHook($key);

        if (is_null($project))
            abort(404);

        Queue::push(new DeployProjectJob($project->getName()));

        return response()->json(["ok"]);
    }

    private function loadProjects()
    {
        /** @var Deployer $deployer */
        $deployer = app(Deployer::class);

        $finder = new Finder();
        $finder->files()->name("*.yaml")->in(base_path('/projects'));

        /** @var File $file */
        foreach ($finder as $file) {

            try {

                $this->projects[] = $deployer->getProject($file->getBasename(".yaml"));

            } catch (ConfigurationException $e) {

                // Prevent misconfigured projects to be loaded

            }
        }
    }


    /**
     * @param string $hook
     * @return Project|null
     */
    private function findProjectFromHook(string $hook)
    {
        return array_first($this->projects, function (Project $project) use ($hook) {

            return $project->getHookKey() === $hook;

        });
    }
}

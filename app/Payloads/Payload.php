<?php


namespace App\Payloads;



use App\Project;

class Payload
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Payload constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Extract the ssh url from the payload
     * @return string
     * @throws \Exception
     */
    public function getRepository(): string
    {
        throw new \Exception("You should override this method.");
    }

    /**
     * Extract the updated branch from the payload
     * @return string
     * @throws \Exception
     */
    public function getBranch(): string
    {
        throw new \Exception("You should override this method.");
    }

    /**
     * Check if it's relevent to deploy a new release according to this payload
     * @return bool
     * @throws \Exception
     */
    public function isRelevent(): bool
    {
        throw new \Exception("You should override this method");
    }

    /**
     * Check if the payload match the given project
     * @param Project $project
     * @return bool
     * @throws \Exception
     */
    public function isProject(Project $project): bool
    {
        return $project->getRepository() === $this->getRepository()
            && $project->getBranch() === $this->getBranch();
    }
}
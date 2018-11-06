<?php


namespace App\Console\Command;

use Eliepse\Deployer\Command\CreateProjectCommand as CreateProjectCommandBase;
use Eliepse\Deployer\Config\Config;
use Eliepse\Deployer\Config\ProjectConfig;
use Eliepse\Deployer\Deployer;
use Eliepse\Deployer\Project\Project;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Yaml\Yaml;

class CreateProjectCommand extends CreateProjectCommandBase
{

    public function __construct(?string $name = null, Deployer $deployer = null)
    {
        parent::__construct($name);

        $this->deployer = app(Deployer::class);
    }

    protected function configure()
    {
        $this->setName("project:create")
            ->setDescription("Create a new project configuration file")
            ->addArgument("name", InputArgument::OPTIONAL, "The name of the project.");
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Eliepse\Deployer\Exception\ConfigurationException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $help */
        $help = $this->getHelper("question");
        $name = $input->getArgument("name");

        $config = ProjectConfig::load((new Deployer)->getProjectsPath() . "/sample.yaml");

        if (empty($name))
            $name = $help->ask($input, $output, new Question("Name of the project: "));

        $name = mb_convert_case($name, MB_CASE_LOWER);
        $filepath = $this->deployer->getProjectsPath() . "/$name.yaml";

        if (file_exists($filepath)) {
            $output->writeln("<error>Project's config file already exists</error>");
            $output->writeln("<comment>Abort.</comment>");
            exit();
        }

        $config->set("provider", $help->ask($input, $output, new ChoiceQuestion("Were is your repo. ? [0]", ["github", "bitbucket"], 0)));

        $config->set("git_url",
            $this->getSshGitUrl($config,
                $help->ask($input, $output, new Question("Name of repository (ex: author/name): "))
            )
        );

        $config->set("git_branch", $help->ask($input, $output, new Question("Repository branch [master]: ", "master")));

        $config->set("deploy_path", $help->ask($input, $output, new Question("Path to folder where to deploy the project: ")));

        $config->set("hook_key", md5(microtime()));

        file_put_contents($filepath, Yaml::dump($config->getAll(), 3));

        $output->writeln("<comment>Project's config file created at $filepath</comment>");

    }

    private function getSshGitUrl(ProjectConfig $config, string $repository)
    {
        switch ($config->get("provider")) {
            case "bitbucket":
                return "git@bitbucket.org:" . $repository;
                break;
            case "github":
            default:
                return "git@github.com:" . $repository;
        }
    }


}
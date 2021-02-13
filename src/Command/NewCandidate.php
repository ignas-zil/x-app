<?php


namespace App\Command;


use App\Service\EmployerService;
use App\Service\JobCandidateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class NewCandidate
 * @package App\Command
 */
class NewCandidate extends Command
{
    private $employer;
    private $jobcandidate;

    protected static $defaultName = 'cron:new-candidate';

    /**
     * NewCandidate constructor.
     * @param EmployerService $employer
     * @param JobCandidateService $jobcandidate
     */
    public function __construct(EmployerService $employer, JobCandidateService $jobcandidate)
    {
        $this->employer = $employer;
        $this->jobcandidate = $jobcandidate;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Saves new candidate.')
            ->setHelp('This command allows you to create new candidate')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the candidate.')
            ->addArgument('experience', InputArgument::REQUIRED, 'The experience of the candidate.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $experience = $input->getArgument('experience');

        if ($experience != 0 && $experience != 1) {
            $output->writeln('Experience must be 0 or 1!');
            return Command::FAILURE;
        }
        $output->writeln('New Candidate:');
        $output->writeln('Name: '.$name.' Experience: '.$experience);

        $this->jobcandidate->setName($name);
        $this->jobcandidate->setExperience($experience);

        $message = $this->employer->newEmployee($this->jobcandidate);
        $output->writeln($message);

        return Command::SUCCESS;
    }

}
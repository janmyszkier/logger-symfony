<?php

namespace AppBundle\Command;

use AppBundle\Services\LogBrowserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LastHourLogsCommand extends ContainerAwareCommand{

    public function __construct(LogBrowserService $logBrowserService)
    {
        $this->logBrowser = $logBrowserService;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('logs:send')
            ->setDescription('Send logs from last hour to email defined in parameter: log.email_recipient');

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $hourAgo = strtotime('-1hour');

        /* @var LogBrowserService $logBrowser */
        $logs = $this->logBrowser->getBetween($hourAgo);

        $output->writeln(count($logs)." request(s) sent last hour!");
    }
}
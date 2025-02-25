<?php

declare(strict_types=1);

namespace App\Presentation\Cli;

use App\Application\ApiFetcherService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'api:fetcher', description: 'CLI to fetch data from API')]
class ApiFetcherCommand extends Command
{
    public function __construct(
        private readonly ApiFetcherService $apiFetcherService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('resourceName', InputArgument::REQUIRED);
        $this->addArgument('option', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->apiFetcherService->fetch(
            $input->getArgument('resourceName'),
            $input->getArgument('option')
        );

        dump($result);

        return Command::SUCCESS;
    }
}

<?php

declare(strict_types=1);

namespace App\Presentation\Cli;

use App\Application\ApiFetcherService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(name: 'api:fetcher', description: 'CLI to fetch data from API')]
class ApiFetcherCommand extends Command
{
    public function __construct(
        private readonly ApiFetcherService $apiFetcherService,
        private readonly SerializerInterface $serializer,
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

        $output->writeln(
            $this->serializer->serialize(
                $result,
                JsonEncoder::FORMAT,
                [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]
            )
        );

        return Command::SUCCESS;
    }
}

<?php
namespace ShoppingFeed\CodeStyle\Console;

use ShoppingFeed\Console\Command\Command;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PHPCSCommand extends Command
{
    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new ProcessHelper();
        $process->run($output, [
            'vendor/bin/phpcs',
            'standard=PSR2',
            'report=full',
            './rules'
        ]);
    }

}

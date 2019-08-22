<?php
namespace ShoppingFeed\CodeStyle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PHPCSCommand extends Command
{
    protected function configure()
    {
        $this->setName(
            'sfcs'
        );
        $this->setDescription(
            'Run PHPCS validation check and eventually autofix CS violations'
        );
        $this->addArgument(
            'source',
            InputArgument::REQUIRED | InputArgument::IS_ARRAY,
            'The source(s) folder(s) to analyse, multiples values allowed'
        );
        $this->addOption(
            'standard',
            null,
            InputOption::VALUE_REQUIRED,
            'The standard file to apply',
            dirname(dirname(__DIR__)) . '/phpcs/ruleset.xml'
        );
        $this->addOption(
            'parallel',
            null,
            InputOption::VALUE_REQUIRED,
            'How many process can run simultaneously',
            1
        );
        $this->addOption(
            'ignore',
            null,
            InputOption::VALUE_REQUIRED,
            'Determine paths to exclude when checking'
        );
        $this->addOption(
            'progress',
            null,
            InputOption::VALUE_NONE,
            'Show progress'
        );
        $this->addOption(
            'autofix',
            null,
            InputOption::VALUE_NONE,
            'Determine if the code must be fixed before running CS checks'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProcessHelper $helper */
        $helper  = $this->getHelperSet()->get('process');
        $options = [
            '--standard=' . $input->getOption('standard'),
            '--report=full',
            '--colors',
            '--parallel=' . $input->getOption('parallel'),
            '--ignore=' . $input->getOption('ignore'),
        ];

        array_push($options, ...$input->getArgument('source'));

        if ($input->getOption('progress')) {
            $options[] = '-p';
        }

        if ($input->getOption('autofix')) {
            $command = $options;
            array_unshift($command, 'vendor/bin/phpcbf');
            $helper->run($output, $command, null, null, OutputInterface::VERBOSITY_NORMAL);
        }

        array_unshift($options, 'vendor/bin/phpcs');

        // forward the process exit code to the current command execution
        return $helper
            ->run($output, $options, null, null, OutputInterface::VERBOSITY_NORMAL)
            ->getExitCode();
    }
}

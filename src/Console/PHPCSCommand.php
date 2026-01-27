<?php
namespace ShoppingFeed\CodeStyle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
            InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
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
        $this->addOption(
            'fix-only',
            null,
            InputOption::VALUE_NONE,
            'Determine if the code must be checked after being fixed'
        );
        $this->addOption(
            'exclude',
            null,
            InputOption::VALUE_REQUIRED,
            'A comma separated list of sniff codes to exclude from checking'
        );
        $this->addOption(
            'timeout',
            't',
            InputOption::VALUE_REQUIRED,
            'Set the phpcs timeout',
            600
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $timeout = (float) $input->getOption('timeout');

        /** @var ProcessHelper $helper */
        $helper  = $this->getHelperSet()->get('process');

        $options = [
            '-s',
            '--standard=' . $input->getOption('standard'),
            '--report=full',
            '--colors',
            '--parallel=' . $input->getOption('parallel'),
            '--ignore=' . $input->getOption('ignore'),
        ];

        if ($source = $input->getArgument('source')) {
            array_push($options, ...$source);
        }

        if ($input->getOption('exclude')) {
            $options[] = '--exclude=' . $input->getOption('exclude');
        }

        if ($input->getOption('progress')) {
            $options[] = '-p';
        }

        if ($input->getOption('autofix')) {
            $command = $options;
            array_unshift($command, 'vendor/bin/phpcbf');

            $process = new Process($command);
            $process->setTimeout($timeout);

            $helper->run($output, $process, null, null, OutputInterface::VERBOSITY_NORMAL);

            // We always return success if fix-only to avoid to rerun phpcs after fixing
            if ($input->getOption('fix-only')) {
                return self::SUCCESS;
            }
        }

        array_unshift($options, 'vendor/bin/phpcs');

        $process = new Process($options);
        $process->setTimeout($timeout);

        // forward the process exit code to the current command execution
        return $helper
            ->run($output, $process, null, null, OutputInterface::VERBOSITY_NORMAL)
            ->getExitCode();
    }
}

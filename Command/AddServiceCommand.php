<?php
namespace AfrikPay\OTPBundle\Command;

use AfrikPay\OTPBundle\Manager\ParamsManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddServiceCommand extends Command
{

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'otp:service:new';

    private $params;


    public function __construct(ParamsManager $params)
    {
        parent::__construct();
        $this->params = $params;
    }

    protected function configure()
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Install OTP Bundle')
        ->addOption(
            'colors',
            null,
            InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            'Which colors do you like?',
            ['blue', 'red'])

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command install the otp bundle');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Creation des Paramètres',
            '==============================',
            '',
        ]);

        $output->writeln('User successfully generated!');
    }
}
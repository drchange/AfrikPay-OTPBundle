<?php
namespace AfrikPay\OTPBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AfrikPay\OTPBundle\Manager\ParamsManager;

class SetupSMSAPICommand extends Command
{

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'otp:setup:sms';

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
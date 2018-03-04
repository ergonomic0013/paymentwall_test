<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;

class CreateDbCommand extends Command
{
    protected function configure()
    {
        $this->setName('db:setup')
            ->setDescription('Command for setup DB and create table')
            ->setHelp('Create DB with specified parameter');      
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Creating database ... ';
        if ($this->createDatabase($input, $output)) {
            $text .= 'database successfully created ...';
        } else {
            $text .= 'database could not be created ...';
        }
        $output->writeln($text);

        $text = 'Creating ...';
        if ($this->createTable($input, $output)) {
            $text .= 'table successfully created ...';
        } else {
            $text .= 'table could not be created ...';
        }
        $output->writeln($text);
    }

    protected function createDatabase($input, $output)
    {
        $app = $this->getApplication();
        $input = new ArrayInput(array('command'=>'doctrine:database:create'));
        $returnCode = $app->doRun($input, $output);
        if($returnCode == 0) {
            return true;
        } else {
           return false;
        }
    }

    protected function createTable(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getApplication();
        $input = new ArrayInput(array('command'=>'doctrine:schema:update', '--force'=>true));
        $returnCode = $app->doRun($input, $output);
        if($returnCode == 0) {
            return true;
        } else {
           return false;
        }
    }

}
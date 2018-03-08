<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Feed;

class AddFeedCommand extends Command
{
    private $em;

    public function __construct(ObjectManager $em)
    {
      Command::__construct();
        $this->em = $em;
    }
    protected function configure()
    {
      $this->setName('feed:add')
            ->setDescription('Add new feed')
            ->setHelp('Add new feed')
            ->addOption(
            'name',
            'na',
            InputOption::VALUE_REQUIRED,
            'Enter the feed name: ',
            null
              )
            ->addOption(
            'url',
            'ur',
            InputOption::VALUE_REQUIRED,
            'Enter URL: ',
            null
              );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {  
      $name = $input->getOption('name');
      $url = $input->getOption('url');

      $this->validateName($name, $output);
      $this->validateUrl($url, $output);

      $feed = new Feed();
      $feed->setName($name);
      $feed->setUrl($url);
      $feed->setLastUpdate(date("Y-m-d H:i:s"));

      $this->em->persist($feed);
      $this->em->flush();

      $output->writeln('Feed was saved with id : '.$feed->getId());
    }

    private function validateName($name, $output)
    {
        if (empty($name)) {
            $output->writeln("<error>Field 'namee' is empty</error>");
            exit();
        }
    }
    private function validateUrl($url, $output)
    {
        if (empty($url)) {
            $output->writeln("<error>Field 'URL' is empty</error>");
            exit();
        }
    }
}
?>
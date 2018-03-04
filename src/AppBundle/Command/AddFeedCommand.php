<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
//use Doctrine\ORM\EntityManager;
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
            ->setDescription('Create new item')
            ->setHelp('Create new feed-element')
            ->addOption(
            'title',
            'ti',
            InputOption::VALUE_REQUIRED,
            'Enter the title: ',
            null
              )
            ->addOption(
            'text',
            'te',
            InputOption::VALUE_REQUIRED,
            'Enter text: ',
            null
              )
            ->addOption(
            'author',
            'a',
            InputOption::VALUE_REQUIRED,
            'Author: ',
            null
              )
            ->addOption(
            'category',
            'c',
            InputOption::VALUE_REQUIRED,
            'Category [comedy, dramma, fantasy]: ',
            null
              );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {  
      $title = $input->getOption('title');
      $text = $input->getOption('text');
      $author = $input->getOption('author');
      $category = $input->getOption('category');

      $this->validateTitle($title, $output);
      $this->validateText($text, $output);
      $this->validateAuthor($author, $output);
      $this->validateCategory($category, $output);

      $feed = new Feed();
      $feed->setTittle($title);
      $feed->setText($text);
      $feed->setAuthor($author);
      $feed->setCategory($category);
      $feed->setCreatedTime(date("Y-m-d H:i:s"));

      $this->em->persist($feed);
      $this->em->flush();

      $output->writeln('Item was saved with id : '.$feed->getId());
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        
        
    }

    protected function validateTitle($title, $output)
    {
        if (empty($title)) {
            $output->writeln("<error>Field 'title' is empty</error>");
            exit();
        }
    }

    protected function validateText($text, $output)
    {
        if (empty($text)) {
            $output->writeln("<error>Field 'text' is empty</error>");
            exit();
        }
    }

    protected function validateAuthor($author, $output)
    {
        if (empty($author)) {
            $output->writeln("<error>Field 'author' is empty</error>");
            exit();
        }
    }

    protected function validateCategory($category, $output)
    {$output->writeln($category);
      if($category != 'dramma' && $category != 'comedy' && $category != 'fantasy'){
            $output->writeln("<error>Field 'category' is not correct</error>");
            exit();
      }
    }    

}
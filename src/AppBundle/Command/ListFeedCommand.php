<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Feed;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Console\Helper\Table;

class ListFeedCommand extends Command
{
    private $em;

    public function __construct(ObjectManager $em)
    {
      Command::__construct();
        $this->em = $em;
    }

	protected function configure()
    {
        $this->setName('feed:list')
            ->setDescription('Show all items');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $item = $this->em->getRepository(Feed::class)->findAll();
        $table = new Table($output);
        //print_r($propertyAccessor->getValue($item, '[1].id'));die();
        $a = Array();
        for ($i=0; $i < count($item) ; $i++) {
            $b = Array();
            for ($n=0; $n < 3; $n++) { 
                $n = 0;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].id");
                $n++;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].tittle");
                $n++;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].author");
                $n++; 
            }

        $a[$i] = $b;
        }
        
            $table
                ->setHeaders(array('Id', 'Title', 'Author'))
                ->setRows($a);

            $table->render();
    }
}
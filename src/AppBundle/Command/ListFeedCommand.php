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
            ->setDescription('Show all feeds');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $item = $this->em->getRepository(Feed::class)->findAll();
        $table = new Table($output);

        $a = Array();
        for ($i = 0; $i < count($item) ; $i++) {
            $b = Array();
            for ($n = 0; $n < 3; $n++) { 
                $n = 0;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].id");
                $n++;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].name");
                $n++;
                $b[$n] = $propertyAccessor->getValue($item, "[$i].lastUpdate");
                $n++; 
            }

        $a[$i] = $b;
        }
        
            $table
                ->setHeaders(array('Id', 'Name', 'Last_update'))
                ->setRows($a);

            $table->render();
    }
}
?>
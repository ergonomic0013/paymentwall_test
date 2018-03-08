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
use AppBundle\Model\Rss;

class CurrentFeedCommand extends Command
{
    private $em;

    public function __construct(ObjectManager $em)
    {
      Command::__construct();
        $this->em = $em;
    }

	protected function configure()
    {
        $this->setName('feed:items')
            ->setDescription('Show current items of a feed')
            ->addArgument('id', InputArgument::REQUIRED, 'Id which items you need to display');;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');

        $item = $this->em->getRepository(Feed::class)->find($id);
        $xml = $item->getUrl();

        $rss = new Rss($xml);
        $rssItems = $rss->getItemsFeed();
        
        $table = new Table($output);
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
      // print_r($rssItems[1]['pubDate']);die();
        $a = Array();
        for ($i = 0; $i < count($rssItems) ; $i++) {
            $b = Array();
            for ($n = 0; $n < 2; $n++) { 
                $n = 0;
                $b[$n] = $rssItems[$i]['title'];
                $n++;
                $b[$n] = $rssItems[$i]['pubDate'];
                $n++;
            }

        $a[$i] = $b;
        }


        $table
            ->setHeaders(array('Title', 'Created_time'))
            ->setRows($a);

        $table->render();
    }
}
?>
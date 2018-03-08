<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Feed;
use Doctrine\Common\Persistence\ObjectManager;

class RemoveFeedCommand extends Command
{
    private $em;

    public function __construct(ObjectManager $em)
    {
      Command::__construct();
        $this->em = $em;
    }

	protected function configure()
    {
        $this->setName('feed:remove')
            ->setDescription('Show all items')
            ->addArgument('id', InputArgument::REQUIRED, 'Id for removing');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');

		$item = $this->em->getRepository(Feed::class)->find($id);
        $this->em->remove($item);
        $this->em->flush();
        $output->writeln('Item with id = '.$id.' was deleted!');
    }
}
?>
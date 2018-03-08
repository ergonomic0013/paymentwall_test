<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Feed;
use AppBundle\Form\FeedType;
use AppBundle\Model\Rss;


class FeedController extends Controller
{
    public function listAction(Request $request)
    {   

        $feed = new Feed();
        $form = $this->createForm(FeedType::class, $feed);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $xml = $form->getData()->getName()->getUrl(); 
            
            $rss = new Rss($xml);
            $rssFeed = $rss->getRssFeed();     
            $rssItems = $rss->getItemsFeed(); 
        }


    


        return $this->render('AppBundle:Feed:list.html.twig', array(
            'form' => $form->createView(),
            'channel' => $rssFeed,
            'items' => $rssItems,
        ));
    }

    public function itemAction($id)
    {
     
        return $this->render('AppBundle:Feed:item.html.twig', array(
            
        ));
    }

}
?>
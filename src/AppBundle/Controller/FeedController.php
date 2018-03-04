<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FeedController extends Controller
{
    public function listAction()
    {
        $em = getDoctrine()->getRepository();
        $all = $em->findAll();


        return $this->render('AppBundle:Feed:list.html.twig', array(
            // ...
        ));
    }

    public function itemAction($id)
    {
        $em = getDoctrine()->getRepository();
        $item = $em->find($id);

        return $this->render('AppBundle:Feed:item.html.twig', array(
            // ...
        ));
    }

}

<?php

namespace TP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('TPCoreBundle::layout.html.twig'); // :: nécessaires a la racine
    }
    
    public function contactAction()
    {
        return $this->render('TPCoreBundle:Core:contact.html.twig');
    }
}

<?php

namespace TP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('TPCoreBundle::layout.html.twig'); // :: nécéssaires a la racine
    }
}

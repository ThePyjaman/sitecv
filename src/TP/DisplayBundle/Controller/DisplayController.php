<?php

namespace TP\DisplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DisplayController extends Controller
{
    public function indexAction()
    {
        // ici on va display l'ensemble des projets
        return $this->render('TPDisplayBundle:Default:index.html.twig');
    }
    
    public function viewAction($id)
    {
        // ici on va display un projet défini
    }
}

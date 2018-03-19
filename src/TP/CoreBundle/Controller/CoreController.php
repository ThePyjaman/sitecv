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
        if ($request->isMethod('POST')) 
        {
            // envoyer le mail ici
            
            $request->getSession()->getFlashBag()->add('notice', 'Message envoyé avec succès!');
            return $this->redirectToRoute('tp_core_contact');
        }
        return $this->render('TPCoreBundle:Core:contact.html.twig');
    }
}

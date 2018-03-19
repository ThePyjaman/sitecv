<?php

namespace TP\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use TP\CoreBundle\Entity\Contact;
    

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('TPCoreBundle::layout.html.twig'); // :: nécessaires a la racine
    }
    
    
    
    public function contactAction(Request $request)
    {
        if ($request->isMethod('POST')) 
        {
            // envoyer le mail ici
            
            $request->getSession()->getFlashBag()->add('notice', 'Mail envoyé avec succès!');
            return $this->redirectToRoute('tp_core_contact');
        }
        $contact = new Contact;
        
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $contact)
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('subject', TextType::class)
            ->add('message', TextareaType::class)
            ->add('Save', SubmitType::class)
        ;
        $form = $formBuilder->getForm();
        
        return $this->render('TPCoreBundle:Core:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

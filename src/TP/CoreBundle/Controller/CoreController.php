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
        
        $contact = new Contact;
        
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $contact)
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('message', TextareaType::class)
            ->add('Save', SubmitType::class)
        ;
        $form = $formBuilder->getForm();
        
        if ($request->isMethod('POST')) 
        {
            
            $form->handleRequest($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Message reçu!');
                
                // envoi du mail
                $message = \Swift_Message::newInstance()
 
               ->setSubject('Merci de votre attention!')
               ->setFrom('test@test.com')
               ->setTo($contact->getEmail())
               ->setBody($this->renderView('TPCoreBundle:Core:email.html.twig',array('name' => $contact->getName())),'text/html');
 
                $this->get('mailer')->send($message);
                
                return $this->redirectToRoute('tp_core_contact');
            }
            
            
        }
        return $this->render('TPCoreBundle:Core:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

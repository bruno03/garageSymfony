<?php

namespace GP\PlatformBundle\Controller;

use GP\PlatformBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GP\PlatformBundle\Form\CustomerType;


class CustomerController extends Controller
{
    //Method to see the homepage
    public function indexAction()
    {
        return $this->render('GPPlatformBundle:Customer:index.html.twig');
    }
    
    //Method to see 1 detail customer
    public function viewAction($id)
    {
        
        $customer = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Customer', $id);
        
         // Le render ne change pas, on passait avant un tableau, maintenant un objet
    return $this->render('GPPlatformBundle:Customer:view.html.twig', array(
      'customer' => $customer
    ));
    }
    
    //Metod to add a new Customer
    public function addAction(Request $request)
    {
        //Creation of the form
        $customer = new Customer();
        $form = $this->get('form.factory')->create(new CustomerType(), $customer);
        
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Client bien enregistré.');
            //Redirection on the page customer detailled
            return $this->redirect($this->generateUrl('gp_platform_view', array('id' => $customer->getId())));
        }
        
        return $this->render('GPPlatformBundle:Customer:add.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
    
    //Method to modify a customer
    public function editAction($id, Request $request)
    {
        $customer = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Customer', $id);
        
        // Et on construit le formBuilder avec cette instance d'annonce
        $form = $this->get('form.factory')->create(new CustomerType(), $customer);   
             
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Client modifié.');
            //Redirection on the page customer detailled
            return $this->redirect($this->generateUrl('gp_platform_view', array('id' => $customer->getId())));
        }
        
        return $this->render('GPPlatformBundle:Customer:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    //Method to delete a particular customer
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $customer = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Customer', $id);
        
        if (null === $customer) {
            throw new NotFoundHttpException("le client d'id ".$id." n'existe pas.");
        }
        
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();
        
        if ($form->handleRequest($request)->isValid()) {
            $em->remove($customer);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('info', "le client a bien été supprimée.");
        
            return $this->redirect($this->generateUrl('gp_platform_home'));
        }
        
        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('GPPlatformBundle:Customer:delete.html.twig', array(
            'customer' => $customer,
            'form'   => $form->createView()
        ));
        
        return $this->render('GPPlatformBundle:Customer:delete.html.twig');
    }
    
    public function searchAction()
    {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('GPPlatformBundle:Customer')
        ;
        
        $customers = $repository->findAll();
        
        
    return $this->render('GPPlatformBundle:Customer:search.html.twig', array(
      'customers' => $customers
    ));
    
    }
}
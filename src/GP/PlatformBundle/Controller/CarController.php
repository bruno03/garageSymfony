<?php

namespace GP\PlatformBundle\Controller;

use GP\PlatformBundle\Entity\Customer;
use GP\PlatformBundle\Entity\Image;
use GP\PlatformBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GP\PlatformBundle\Form\CustomerType;
use GP\PlatformBundle\Form\ImageType;
use GP\PlatformBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class CarController extends Controller
{
    //Metod to add a new Car
    public function addAction(Request $request, $id)
    {
    	$customer = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Customer', $id);
		
        //Creation of the form
        $car = new Car();
        $form = $this->get('form.factory')->create(new CarType(), $car);
        
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {        
            $em = $this->getDoctrine()->getManager();
			$car->setCustomer($customer);
            $em->persist($car);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Voiture bien enregistré.');
            //Redirection on the page customer detailled
            return $this->redirect($this->generateUrl('gp_platform_view', array('id' => $id)));
        }
        
        return $this->render('GPPlatformBundle:Car:add.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
	
	//Metod to edit a Car
    public function editAction(Request $request, $id)
    {
    	$car = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Car', $id);
		
        $form = $this->get('form.factory')->create(new CarType(), $car);
		
        
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Voiture bien enregistré.');
            //Redirection on the page customer detailled
            return $this->redirect($this->generateUrl('gp_platform_view', array('id' => $car->getCustomer()->getId())));
        }
        
        return $this->render('GPPlatformBundle:Car:edit.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
	
	//Metod to delete a Car
    public function deleteAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
        
        $car = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Car', $id);
        
        if (null === $car) {
            throw new NotFoundHttpException("la voiture d'id ".$id." n'existe pas.");
        }
        
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();
        
        if ($form->handleRequest($request)->isValid()) {
            $em->remove($car);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('info', "la voiture a bien été supprimée.");
        
            return $this->redirect($this->generateUrl('gp_platform_home'));
        }
        
        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('GPPlatformBundle:Car:delete.html.twig', array(
            'car' => $car,
            'form'   => $form->createView()
        ));
        
        return $this->render('GPPlatformBundle:Car:delete.html.twig');
       
    }
}

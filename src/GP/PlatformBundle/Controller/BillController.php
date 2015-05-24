<?php

namespace GP\PlatformBundle\Controller;

use GP\PlatformBundle\Entity\Customer;
use GP\PlatformBundle\Entity\Image;
use GP\PlatformBundle\Entity\Car;
use GP\PlatformBundle\Entity\Bill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GP\PlatformBundle\Form\CustomerType;
use GP\PlatformBundle\Form\ImageType;
use GP\PlatformBundle\Form\CarType;
use GP\PlatformBundle\Form\BillType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class BillController extends Controller
{
    //Metod to add a new Bill
    public function addAction(Request $request)
    {
        //Creation of the form
        $bill = new Bill();
        $form = $this->get('form.factory')->create(new BillType(), $bill);
        
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($bill);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Facture bien enregistré.');
            //Redirection on the page customer detailled
            return $this->render('GPPlatformBundle:Customer:index.html.twig');
        }
        
        return $this->render('GPPlatformBundle:Bill:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
	
	//Method to see 1 detail bill
    public function viewBillAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
		$bill = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Bill', $id);
		
    	return $this->render('GPPlatformBundle:Bill:detail.html.twig', array(
      	'bill' => $bill
    	));
    }
	
	//Metod to see all the bills
    public function viewBillsAction()
    {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('GPPlatformBundle:Bill');
        
        $bills = $repository->findAll();
        
    	return $this->render('GPPlatformBundle:Bill:viewall.html.twig', array(
      			'bills' => $bills
    	));
    }
	
	//Metod to edit a Bill
    public function editAction(Request $request, $id)
    {
    	$bill = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Bill', $id);
		
        $form = $this->get('form.factory')->create(new BillType(), $bill);
		
        
        //Return of the fields of the form
        if ($form->handleRequest($request)->isValid()) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($bill);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('notice', 'Facture bien modifié.');
            //Redirection on the page customer detailled
            return $this->redirect($this->generateUrl('gp_platform_viewBill', array('id' => $id)));
        }
        
        return $this->render('GPPlatformBundle:Bill:edit.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
	
	//Metod to delete a Bill
    public function deleteAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
        
        $bill = $this->getDoctrine()
        ->getManager()
        ->find('GPPlatformBundle:Bill', $id);
        
        if (null === $bill) {
            throw new NotFoundHttpException("la facture d'id ".$id." n'existe pas.");
        }
        
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->createFormBuilder()->getForm();
        
        if ($form->handleRequest($request)->isValid()) {
            $em->remove($bill);
            $em->flush();
        
            $request->getSession()->getFlashBag()->add('info', "la facture a bien été supprimée.");
        
            return $this->redirect($this->generateUrl('gp_platform_home'));
        }
        
        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('GPPlatformBundle:Bill:delete.html.twig', array(
            'bill' => $bill,
            'form'   => $form->createView()
        ));
        
        return $this->render('GPPlatformBundle:Bill:delete.html.twig');
       
    }
}

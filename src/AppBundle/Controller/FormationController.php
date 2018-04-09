<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FormationType;
use AppBundle\Entity\Formation;

/**
 * @Route("/formations")
 */
 
class FormationController extends Controller
{
    /**
      * @Route("/create", name="create_formation")
      * @Template()
      */
    public function createAction()
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
          
        return array(
              'entity' => $formation,
              'form' => $form->createView(),
              );
    }
      
    /**
    * @Route("/save", name="save_formation")
    * @Template()
    */
    public function saveLoiAction()
    {
        $exp = new Formation();
        $exp->setName('Théâtre');
        $exp->setPlace('ComMania - Paris');
        $exp->setDebut('2012');
        $exp->setFin('2016');
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($exp);
        $eManager->flush();
        return array();
    }
    
    /**
     * @Route("/create_valid", name="validate_create_formation")
     * @Method("POST")
     */
    public function validateCreateFormationAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($formation);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_formation', array(
            'entity' => $formation,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="edit_formation")
     * @Template()
     */
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $formation = $eManager->getRepository("AppBundle:Formation")->FindOneBy(["id" => $id]);
        $form = $this->createForm(FormationType::class, $formation);
        return array(
            'entity' => $formation,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_formation")
     * @Method("POST")
     */
    public function validateEditFormationAction(Request $request, $id)
    {
        $formation = $this->getDoctrine()->getRepository('AppBundle:Formation')->FindOneBy(["id" => $id]);
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($formation);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_formation', array(
            'entity' => $formation,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/delete/{id}", name="delete_formation")
     */
    
    public function validateDeleteFormationAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $formation = $eManager->getRepository("AppBundle:Formation")->FindOneBy(["id" => $id]);
        if ($formation == null) {
            return $this->redirectToRoute('homepage', array('error' => true));
        } else {
            $eManager->remove($formation);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
    }
}

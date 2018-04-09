<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\LoisirType;
use AppBundle\Entity\Loisir;

/**
 * @Route("/loisirs")
 */
class LoisirController extends Controller
 {
     /**
      * @Route("/create", name="create_loisir")
      * @Template()
      */
    public function createAction()
     {
         $loisir = new Loisir();
         $form = $this->createForm(LoisirType::class, $loisir);
          
         return array(
              'entity' => $loisir,
              'form' => $form->createView(),
              );
    }
      
     /**
      * @Route("/save", name="save_loisir")
      * @Template()
      */
    public function saveLoiAction()
     {
         $exp = new Loisir();
         $exp->setName('Théâtre');
         $eManager = $this->getDoctrine()->getManager();
         $eManager->persist($exp);
         $eManager->flush();
         return array();
    }
    
     /**
      * @Route("/create_valid", name="validate_create_loisir")
      * @Method("POST")
      */
    public function validateCreateLoisirAction(Request $request)
     {
         $loisir = new Loisir();
         $form = $this->createForm(LoisirType::class, $loisir);
         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $eManager = $this->getDoctrine()->getManager();
             $eManager->persist($loisir);
             $eManager->flush();
             return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_loisir', array(
            'entity' => $loisir,
            'form' => $form->createView(),
        ));
     }
    
     /**
     * @Route("/edit/{id}", name="edit_loisir")
     * @Template()
     */
    public function editAction($id)
     {
         $eManager = $this->getDoctrine()->getManager();
         $loisir = $eManager->getRepository("AppBundle:Loisir")->FindOneBy(["id" => $id]);
         $form = $this->createForm(LoisirType::class, $loisir);
         return array(
            'entity' => $loisir,
            'form' => $form->createView(),
        );
    }
    
     /**
      * @Route("/edit_valid/{id}", name="validate_edit_loisir")
      * @Method("POST")
      */
    public function validateEditLoisirAction(Request $request, $id)
     {
         $loisir = $this->getDoctrine()->getRepository('AppBundle:Loisir')->FindOneBy(["id" => $id]);
         $form = $this->createForm(LoisirType::class, $loisir);
         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $eManager = $this->getDoctrine()->getManager();
             $eManager->persist($loisir);
             $eManager->flush();
             return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_loisir', array(
             'entity' => $loisir,
             'form' => $form->createView(),
        )
        );
     }
    
     /**
     * @Route("/delete/{id}", name="delete_loisir")
     */
    
     public function validateDeleteLoisirAction($id)
     {
         $eManager = $this->getDoctrine()->getManager();
         $loisir = $eManager->getRepository("AppBundle:Loisir")->FindOneBy(["id" => $id]);
         if ($loisir == null) {
             return $this->redirectToRoute('homepage', array('error' => true));
         } else {
             $eManager->remove($loisir);
             $eManager->flush();
             return $this->redirectToRoute('homepage');
         }
     }
 }

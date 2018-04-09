<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ExperienceType;
use AppBundle\Entity\Experience;

/**
 * @Route("/experiences")
 */
 
class ExperienceController extends Controller
{
    /**
      * @Route("/create", name="create_experience")
      * @Template()
      */
    public function createAction()
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
          
        return array(
              'entity' => $experience,
              'form' => $form->createView(),
              );
    }
      
    /**
    * @Route("/save", name="save_experience")
    * @Template()
    */
    public function saveLoiAction()
    {
        $exp = new Experience();
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
     * @Route("/create_valid", name="validate_create_experience")
     * @Method("POST")
     */
    public function validateCreateExperienceAction(Request $request)
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($experience);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_experience', array(
            'entity' => $experience,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="edit_experience")
     * @Template()
     */
    public function editAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $experience = $eManager->getRepository("AppBundle:Experience")->FindOneBy(["id" => $id]);
        $form = $this->createForm(ExperienceType::class, $experience);
        return array(
            'entity' => $experience,
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/edit_valid/{id}", name="validate_edit_experience")
     * @Method("POST")
     */
    public function validateEditExperienceAction(Request $request, $id)
    {
        $experience = $this->getDoctrine()->getRepository('AppBundle:Experience')->FindOneBy(["id" => $id]);
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eManager = $this->getDoctrine()->getManager();
            $eManager->persist($experience);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('create_experience', array(
            'entity' => $experience,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/delete/{id}", name="delete_experience")
     */
    
    public function validateDeleteExperienceAction($id)
    {
        $eManager = $this->getDoctrine()->getManager();
        $experience = $eManager->getRepository("AppBundle:Experience")->FindOneBy(["id" => $id]);
        if ($experience == null) {
            return $this->redirectToRoute('homepage', array('error' => true));
        } else {
            $eManager->remove($experience);
            $eManager->flush();
            return $this->redirectToRoute('homepage');
        }
    }
}

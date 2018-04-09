<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Formation;
class DefaultController extends Controller
{
    /**
     * @Route("/cv", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $formations = $this->getDoctrine()->getRepository("AppBundle:Formation")->findAll();
        $experiences = $this->getDoctrine()->getRepository("AppBundle:Experience")->findAll();
        $loisirs = $this->getDoctrine()->getRepository("AppBundle:Loisir")->findAll();
        
        return array(
            'name' => "ouaritini",
            'firstname' => "rym",
            'formations' => $formations,
            'loisirs' => $loisirs,
            'experiences' => $experiences
        );
    }
    /**
     * @Route("/create/formation", name="create_formation")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $form = new Formation();
        $form->setName("Ma formation");
        $form->setDateDebut(New \DateTime());
        $form->setDateFin(New \DateTime());
        $form->setLieu("Grenoble, France");
        $eManager = $this->getDoctrine()->getManager();
        $eManager->persist($form);
        $eManager->flush();
        return array();
    }
}
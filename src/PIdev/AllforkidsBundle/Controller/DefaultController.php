<?php

namespace PIdev\AllforkidsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIdevAllforkidsBundle:Default:index.html.twig');
    }

    public function homeAction(){
        return $this->render('PIdevAllforkidsBundle:Profile:Home.html.twig');
    }

    public function profileAction(){
        return $this->render('FOSUserBundle:Profile:show.html.twig');
    }

    public function homeAdminAction()
    {
        return $this->render('PIdevAllforkidsBundle:Profile:AccueilAdmin.html.twig');
    }

    public function medecinAction()
    {
        return $this->render('PIdevAllforkidsBundle:Profile:MedecinPage.html.twig');
    }

    public function responsableAction()
    {
        return $this->render('PIdevAllforkidsBundle:Profile:ResponsablePage.html.twig');
    }

    public function actualiteAction(){
        $em=$this->getDoctrine()->getManager();

        $g=$em->getRepository('PIdevAllforkidsBundle:Garderie')->garderieActualitee();
/*
        $e=$em->getRepository('PIdevAllforkidsBundle:Evenement')->EvenementActualitee();

        $c=$em->getRepository('PIdevAllforkidsBundle:Club')->clubActualitee();

        $a=$em->getRepository('PIdevAllforkidsBundle:Association')->associationActualitee();

        $o=$em->getRepository('PIdevAllforkidsBundle:OffreTransport')->offreActualitee();
*/
        return $this->render('PIdevAllforkidsBundle:Profile:Home.html.twig', array('gg'=>$g));
    }


}

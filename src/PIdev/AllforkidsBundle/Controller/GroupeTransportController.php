<?php

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\groupeTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GroupeTransportController extends Controller
{
    public function indexAction()
    {
        return $this->render('PIdevAllforkidsBundle:GroupeTransport:GroupeT.html.twig');
    }

    public function ajoutergroupeAction(Request $request){
        $modele = new groupeTransport();

        if ($request->isMethod("post")) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em=$this->getDoctrine()->getManager();
            $modele2 = $em->getRepository("PIdevAllforkidsBundle:User")->find($user);
            if ($modele2->getIdGrp() == NULL){
                $modele->setNom($request->get('nom'));
                $modele->setTheme($request->get('theme'));
                $modele->setNbrPersonne(1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($modele);
                $em->flush();
                //  $user = $this->get('security.token_storage')->getToken()->getUser();
                $modele2->setIdGrp($modele);
                $em=$this->getDoctrine()->getManager();
                $em->persist($modele2);
                $em->flush();
            }
        }
        return $this->redirectToRoute('Home_Page');
    }

}

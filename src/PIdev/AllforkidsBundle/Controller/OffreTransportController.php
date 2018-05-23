<?php

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\OffreTransport;
use PIdev\AllforkidsBundle\Form\OffreTransportType;
use PIdev\AllforkidsBundle\Form\RechercheOffreAjaxType;
use PIdev\AllforkidsBundle\Form\RechercheOffreTransportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OffreTransportController extends Controller
{

    public function addoffreAction(Request $request){

        $offre = new OffreTransport();
        $form = $this->createForm(OffreTransportType::class, $offre);
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        $modele2 = $em->getRepository("PIdevAllforkidsBundle:User")->find($user);

        if($form->isValid()){
            $offre->setUser($modele2);
            $offre->setPlaceRestant($offre->getNombrePlace());
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute("Rechercher_OffreTransport");
        }

        return $this->render("PIdevAllforkidsBundle:OffreTransport:AddOffreTransport.html.twig", array("offre"=>$form->createView()));
    }

    public function showoffreAction(){
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findAll();

        return $this->render("PIdevAllforkidsBundle:OffreTransport:ListeOffreTransport.html.twig", array("offre"=>$offre));
    }

    public function showdetailoffreAction(Request $request){
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findBy(array('id'=>$id));

        return $this->render("PIdevAllforkidsBundle:OffreTransport:ShowOffreDetail.html.twig", array("offre"=>$offre));
    }

    public function deleteoffreAction(Request $request){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->find($id);
        $em->remove($modele);
        $em->flush();

        return $this->redirectToRoute('Rechercher_OffreTransport');
    }

    public function updateoffreAction(Request $request){
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->find($id);
        $form = $this->createForm(OffreTransportType::class, $offre);
        $form->handleRequest($request);

        if($form->isValid()){
            $offre->setPlaceRestant($offre->getNombrePlace());
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute('Rechercher_OffreTransport');
        }

        return $this->render("PIdevAllforkidsBundle:OffreTransport:UpdateOffreTransport.html.twig", array("offre"=>$form->createView()));

    }

    public function searchoffreAction(Request $request){

        $offre = new OffreTransport();
        $em = $this->getDoctrine()->getManager();

        $Form = $this->createForm(RechercheOffreTransportType::class, $offre);
        $Form->handleRequest($request);

        if($Form->isValid()){
            $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findBy(array('destination'=>$offre->getDestination()));
        }
        else{
            $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findAll();
        }

        return $this->render("PIdevAllforkidsBundle:OffreTransport:SearchOffreTransport.html.twig", array('Form'=>$Form->createView(),'offre'=>$offre));

    }


    public function searchAjaxAction(Request $request){

        $des=$request->get('q');

        $em=$this->getDoctrine()->getManager();
        $offre =$em->getRepository("PIdevAllforkidsBundle:OffreTransport")->searchOffre($des);

        return new JsonResponse($offre);

    }

    public function rechDestination(Request $request){

        $em=$this->getDoctrine()->getManager();
        $offre =$em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findAll();

        if ($request->isMethod('POST'))
        {
            $emplacement = $request->get('destination');
            $offre=$em->getRepository("PIdevAllforkidsBundle:OffreTransport")->trouver ($emplacement);
        }
        return $this->render('PIdevAllforkidsBundle:OffreTransport:SearchAjax.html.twig',array('offre'=>$offre));
    }




    ///////////////////Admin Fonctions\\\\\\\\\\\\\\\\\\

    public function adminshowoffreAction(){
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findAll();

        return $this->render("PIdevAllforkidsBundle:OffreTransport:AdminOffreTransport.html.twig", array("offre"=>$offre));
    }

    public function admindeleteoffreAction(Request $request){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->find($id);
        $em->remove($modele);
        $em->flush();

        return $this->redirectToRoute('Admin_Liste_OffreTransport');
    }

    public function adminsearchoffreAction(Request $request){

        $offre = new OffreTransport();
        $em = $this->getDoctrine()->getManager();

        $Form = $this->createForm(RechercheOffreTransportType::class, $offre);
        $Form->handleRequest($request);

        if($Form->isValid()){
            $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findBy(array('destination'=>$offre->getDestination()));
        }
        else{
            $offre = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->findAll();
        }

        return $this->render("PIdevAllforkidsBundle:OffreTransport:AdminRechercheOffreTransport.html.twig", array('Form'=>$Form->createView(),'offre'=>$offre));

    }


}

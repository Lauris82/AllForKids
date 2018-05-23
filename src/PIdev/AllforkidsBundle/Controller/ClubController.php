<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/02/2018
 * Time: 22:50
 */

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Club;
use PIdev\AllforkidsBundle\Form\ClubType;
use spec\AncaRebeca\FullCalendarBundle\Service\SerializerSpec;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ClubController extends Controller
{
   /* public function listerAction(){

        $em=$this->getDoctrine()->getManager();
        $clubs=$em->getRepository('PIdevAllforkidsBundle:Club')->findAll();

        return $this->render('PIdevAllforkidsBundle:Club:Lister.html.twig',array("C"=>$clubs));
    }*/




    public function ajouterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $modele = $em->getRepository('PIdevAllforkidsBundle:User')->find($us);

        $club= new Club();
        $form = $this->createForm(ClubType::class,$club);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $club->setUser($modele);
            $em->persist($club); // insert into table
            $em->flush(); //executer
            return $this->redirectToRoute('Lister_Club');
        }
        return $this->render('PIdevAllforkidsBundle:Club:ajout2.html.twig', array( 'form'=>$form->createView()  ));




    }


    public function modifierAction($id,Request $request){

        // $id=$request->get('id_aasociation');
        $em=$this->getDoctrine()->getManager();
        $club=$em->getRepository('PIdevAllforkidsBundle:Club')->find($id);
        $Form=$this->createForm(ClubType::class,$club);
        $Form->handleRequest($request);

        if($Form->isValid()){

            $em->persist($club);
            $em->flush();
            return $this->redirect($this->generateUrl("Lister_Club"));

        }

        return $this->render('PIdevAllforkidsBundle:Club:modifier.html.twig',array("form"=>$Form->createView()));
    }


    public function supprimerAction($id){

        $em=$this->getDoctrine()->getManager();
        $Ass=$em->getRepository('PIdevAllforkidsBundle:Club')->find($id);
        $em->remove($Ass);
        $em->flush();

        return ($this->redirectToRoute('Lister_Club'));


    }

    public function rechercherAction (Request $request){

        $criteria=$request->get('gouv');
        $em=$this->getDoctrine()->getManager();
        $clubs=$em->getRepository('PIdevAllforkidsBundle:Club')->findBy(array('gouvernorat'=>$criteria));
        $c=$em->getRepository('PIdevAllforkidsBundle:Club')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $clubb=$paginator->paginate(
            $c,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        dump(get_class($paginator));


        if($request->isMethod('post')){

            $clubs=$em->getRepository('PIdevAllforkidsBundle:Club')->findcl($request->get('no'),$criteria);
            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator=$this->get('knp_paginator');
            $clubb2=$paginator->paginate(
                $clubs,
                $request->query->getInt('page',1),
                $request->query->getInt('limit',2)
            );
            dump(get_class($paginator));


            return $this->render('PIdevAllforkidsBundle:Club:rechercher.html.twig',array("C"=>$clubb2));

        }



        return $this->render('PIdevAllforkidsBundle:Club:rechercher.html.twig',array("C"=>$clubb));

    }




    public function listerAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $CL=$em->getRepository('PIdevAllforkidsBundle:Club')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $clubs=$paginator->paginate(
            $CL,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );
        dump(get_class($paginator));

        return $this->render('PIdevAllforkidsBundle:Club:Lister2.html.twig',array("C"=>$clubs));
    }




    public function consulterAction($id ){

        $em=$this->getDoctrine()->getManager();
        $a=$em->getRepository("PIdevAllforkidsBundle:Club")->findBy(array('idclub'=>$id));



        return $this->render('PIdevAllforkidsBundle:Club:ConsulterClub.html.twig',array("cl"=>$a));


    }





    public function homeRCAction(){
        return $this->render('PIdevAllforkidsBundle:Club:pageResponsableClub.html.twig');
    }


    public function allAction(){
        $CLUB=$this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:Club')->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($CLUB);
        return new JsonResponse($formatted);

    }

    public function newAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $CLUB=new Club();
        $CLUB->setNom($request->get('nom'));
        $CLUB->setDescription($request->get('description'));
        $CLUB->setNumTel($request->get('numTel'));
        $CLUB->setGouvernorat($request->get('gov'));
        $em->persist($CLUB);
        $em->flush();
        $serialiser=new Serializer([new ObjectNormalizer()]);
        $formatted=$serialiser->normalize($CLUB);
        return new JsonResponse($formatted);

    }

    public function modifAction(Request $request){
        $id=$request->get('idc');
        echo ("test");
        $em=$this->getDoctrine()->getManager();
        $club=$em->getRepository('PIdevAllforkidsBundle:Club')->find($id);


        $club->setNom($request->get('n'));
        $club->setDescription($request->get('d'));
        $club->setNumTel($request->get('nu'));

        $club->setGouvernorat($request->get('g'));

        $em->persist($club);
        $em->flush();
    $serializer=new Serializer([new ObjectNormalizer()]);
    $formatted=$serializer->normalize($club);
    return new JsonResponse($formatted);

    }





}
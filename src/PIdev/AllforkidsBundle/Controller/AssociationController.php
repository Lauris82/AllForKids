<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/02/2018
 * Time: 15:05
 */

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Association;
use PIdev\AllforkidsBundle\Form\AssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AssociationController extends Controller
{
    public function testAction(){

        return $this->render('PIdevAllforkidsBundle:Association:test.html.twig');
    }


    public function listAction(Request $request){

     $em=$this->get('doctrine.orm.entity_manager');
     $dql="SELECT a FROM PIdevAllforkidsBundle:Association a";
     $query=$em->createQuery($dql);

     $paginator=$this->get('knp_paginator');
     $pagination=$paginator ->paginate($query,$request -> requête -> getInt ( ' page ' , 1 ),10);

     return $this->render('PIdevAllforkidsBundle:Association:list.html.twig', array ('pagination' => $pagination ));

 }


    public function ajouterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $modele = $em->getRepository('PIdevAllforkidsBundle:User')->find($us);

        $ass= new Association();
        $form = $this->createForm(AssociationType::class,$ass);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $ass->setUser($modele);
            $em->persist($ass); // insert into table
            $em->flush(); //executer
            return $this->redirectToRoute('Lister_Associations');
        }
        return $this->render('PIdevAllforkidsBundle:Association:ajout2.html.twig', array( 'form'=>$form->createView()  ));
    }


    public function modifierAction($id,Request $request){

       // $id=$request->get('id_aasociation');
        $em=$this->getDoctrine()->getManager();
        $Ass=$em->getRepository('PIdevAllforkidsBundle:Association')->find($id);
        $Form=$this->createForm(AssociationType::class,$Ass);
        $Form->handleRequest($request);

        if($Form->isValid()){

            $em->persist($Ass);
            $em->flush();
            return $this->redirect($this->generateUrl("Lister_Associations"));

        }

        return $this->render('PIdevAllforkidsBundle:Association:modifier2.html.twig',array("form"=>$Form->createView(),"A"=>$Ass));

    }



    public function supprimerAction($id){

        $em=$this->getDoctrine()->getManager();
        $Ass=$em->getRepository('PIdevAllforkidsBundle:Association')->find($id);
        $em->remove($Ass);
        $em->flush();

        return ($this->redirectToRoute('Lister_Associations'));


    }


    public function rechercher2Action (Request $request){

        $criteria=$request->get('gouv');
        $em=$this->getDoctrine()->getManager();
        $associations=$em->getRepository('PIdevAllforkidsBundle:Association')->findBy(array('gouvernorat'=>$criteria));

        $a=$em->getRepository('PIdevAllforkidsBundle:Association')->findAll();
        $paginator=$this->get('knp_paginator');
        $as=$paginator->paginate(
            $a,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        dump(get_class($paginator));


                if($request->isMethod('post')){

                    $associations=$em->getRepository('PIdevAllforkidsBundle:Association')->findass($request->get('no'),$criteria);
                    $paginator=$this->get('knp_paginator');
                    $asso=$paginator->paginate(
                        $associations,
                        $request->query->getInt('page',1),
                        $request->query->getInt('limit',2)
                    );
                    dump(get_class($paginator));

                    return $this->render('PIdevAllforkidsBundle:Association:recherche3.html.twig',array("ASS"=>$asso));

                }

        return $this->render('PIdevAllforkidsBundle:Association:recherche3.html.twig',array("ASS"=>$as));
    }


    public function listerAction(Request $request){

        $em=$this->getDoctrine()->getManager();
        $associationss=$em->getRepository('PIdevAllforkidsBundle:Association')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $associations=$paginator->paginate(
            $associationss,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );
        dump(get_class($paginator));

        return $this->render('PIdevAllforkidsBundle:Association:Lister4.html.twig',array("ASS"=>$associations));
    }



    public function homeRAAction(){
        return $this->render('PIdevAllforkidsBundle:Association:pageResponsable.html.twig');
    }

    public function homeParentAction(){
        return $this->render('PIdevAllforkidsBundle:Association:pageParent.html.twig');
    }


    public function NombreAAction(){
        $em=$this->getDoctrine()->getManager();
        $Nbr=$em->getRepository('PIdevAllforkidsBundle:Association')->NbrA();
        return $this->render('PIdevAllforkidsBundle:Association:Nbr.html.twig',array("m"=>$Nbr));
    }


    public function consulterAction($id ){

        $em=$this->getDoctrine()->getManager();
        $a=$em->getRepository("PIdevAllforkidsBundle:Association")->findBy(array('id_aasociation'=>$id));



        return $this->render('PIdevAllforkidsBundle:Association:ConsulterAss.html.twig',array("Ass"=>$a));


    }



    public function allAction(){
        $ass=$this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:Association')->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($ass);
        return new JsonResponse($formatted);

    }

    public function newAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $ass=new Association();
        $ass->setNom($request->get('nom'));
        $ass->setDescription($request->get('description'));
        $ass->setNumTel($request->get('numTel'));
        $ass->setGouvernorat($request->get('gov'));
        $em->persist($ass);
        $em->flush();
        $serialiser=new Serializer([new ObjectNormalizer()]);
        $formatted=$serialiser->normalize($ass);
        return new JsonResponse($formatted);

    }

    public function modifAction(Request $request){
        $id=$request->get('idc');
        echo ("test");
        $em=$this->getDoctrine()->getManager();
        $ass=$em->getRepository('PIdevAllforkidsBundle:Association')->find($id);


        $ass->setNom($request->get('n'));
        $ass->setDescription($request->get('d'));
        $ass->setNumTel($request->get('nu'));

        $ass->setGouvernorat($request->get('g'));

        $em->persist($ass);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($ass);
        return new JsonResponse($formatted);

    }





}
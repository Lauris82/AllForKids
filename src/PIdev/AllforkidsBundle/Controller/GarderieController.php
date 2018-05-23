<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/02/2018
 * Time: 23:46
 */

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Galery;
use PIdev\AllforkidsBundle\Entity\Garderie;
use PIdev\AllforkidsBundle\Entity\Rating;
use PIdev\AllforkidsBundle\Entity\Ratingg;
use PIdev\AllforkidsBundle\Entity\User;
use PIdev\AllforkidsBundle\Form\GaleryType;
use PIdev\AllforkidsBundle\Form\GarderieType;
use PIdev\AllforkidsBundle\Form\RatinggType;
use PIdev\AllforkidsBundle\Form\RatingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class GarderieController extends Controller
{
    public function AfficheAction()
    {
        $em =$this->getDoctrine()->getManager();
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->findAll();


        return $this->render('PIdevAllforkidsBundle:Garderie:Affiche.html.twig',array("Garderie" => $Garderie));
    }

    public function AfficheAdminAction()
    {
        $em =$this->getDoctrine()->getManager();
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->findAll();


        return $this->render('PIdevAllforkidsBundle:Garderie:AfficheAdmin.html.twig',array("Garderie" => $Garderie));
    }
    public function SupprimerGarderieAction(Request $request)
    {
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $em->remove($Garderie);
        $em->flush();
        return $this->redirectToRoute('ListeGarderie');

    }
    public function SupprimerGarderieAAction(Request $request)
    {
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $em->remove($Garderie);
        $em->flush();
        return $this->redirectToRoute('affiche_admin');

    }
    public function AjouterGarderieAction(Request $request)
    {
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $Garderie=new Garderie();
        $form=$this->createForm(GarderieType::class,$Garderie);
        $form->handleRequest($request);
        $Garderie->setUser($user);
        //$Garderie->setRating(null);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $Garderie->uploadProfilPicture();
            $em->persist($Garderie);
            $em->flush();
            return $this->redirect($this->generateUrl('ListeGarderie'));
    }
    return $this->render('PIdevAllforkidsBundle:Garderie:ajouterGarderie.html.twig',array('form'=>$form->createView()));
}


public function UpdateGarderieAction(Request $request)
{   $user=$this->get('security.token_storage')->getToken()->getUser();
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
    $form=$this->createForm(GarderieType::class,$Garderie);
    $form->handleRequest($request);
    $Garderie->setUser($user);
    if ($form->isValid()) {
        $Garderie->uploadProfilPicture();
        $em->persist($Garderie);
        $em->flush();
        return $this->redirect($this->generateUrl('ListeGarderie'));
    }
    return $this->render('PIdevAllforkidsBundle:Garderie:updateGarderie.html.twig',array('form'=>$form->createView()));
}

public function RechercheGarderieEmpAction(Request $request)
{
    $em=$this->getDoctrine()->getManager();
   $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->findAll();
if ($request->isMethod('POST'))
{
    $emplacement = $request->get('emplacement');
    $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->trouver ($emplacement);


}
return $this->render('PIdevAllforkidsBundle:Garderie:rechercheEmplacement.html.twig',array('Garderie'=>$Garderie));





}
public function affAcueilAction()
{
    return $this->render('PIdevAllforkidsBundle:Garderie:pageAccueil.html.twig');
}
public function ListeGarderieAction()
{

    $em =$this->getDoctrine()->getManager();
    $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->findAll();


    return $this->render('PIdevAllforkidsBundle:Garderie:ListeGarderie.html.twig',array("Garderie" => $Garderie));

}
public function listeGardAction(Request $request)
{
    //$user=$this->get('security.token_storage')->getToken()->getUser();
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
    $Rates=$em->getRepository("PIdevAllforkidsBundle:Ratingg")->chercher($Garderie);
    return $this->render('PIdevAllforkidsBundle:Garderie:ListeGard.html.twig',array("Garderie" => $Garderie,'Rates'=>$Rates));
}
public function PresentationGardAction(Request $request)
{
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);

    return $this->render('PIdevAllforkidsBundle:Garderie:PresentationGard.html.twig',array("Garderie" => $Garderie));

}
public function VoterAction(Request $request)
{
    $Ratingg=new Ratingg();
    $form=$this->createForm(RatinggType::class,$Ratingg);
    $form->handleRequest($request);
    $user=$this->get('security.token_storage')->getToken()->getUser();
    $id=$request->get('id');

    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);

    $Ratingg->setUser($user);
    $Ratingg->setGarderie($Garderie);


    if ($form->isSubmitted())
    {

        $em->persist($Ratingg);
        $em->flush();


    }





    return $this->render('PIdevAllforkidsBundle:Garderie:voter.html.twig',array('form'=>$form->createView(),'Garderie'=>$Garderie
        ));
}
public function ListeVoterAction(Request $request)
{
   //$user=$this->get('security.token_storage')->getToken()->getUser();
    $id=$request->get('id');

    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
    $Rates=$em->getRepository("PIdevAllforkidsBundle:Ratingg")->chercher($Garderie);

    return $this->render('PIdevAllforkidsBundle:Garderie:ListeVoter.html.twig',array('Garderie'=>$Garderie,'Rates'=>$Rates
    ));

}

    public function searchAction(Request $request)
    {

        $emp=$request->get('q');

        $em=$this->getDoctrine()->getManager();
        $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->search($emp);

        return new JsonResponse($Garderie);

//        ));

    }
    public function galerieAjoutAction (Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $Galery= new Galery();
        $form=$this->createForm(GaleryType::class,$Galery);
        $form->handleRequest($request);
        $Galery->setUser($user);
        $Galery->setGarderie($Garderie);
        if ($form->isValid()) {

            $Galery->uploadProfilPicture();
            $em->persist($Galery);
            $em->flush();
           return $this->redirect($this->generateUrl('ListeGarderie'));
//            $this->render('PIdevAllforkidsBundle:Garderie:galerieaffiche.html.twig',array('Garderie'=>$Garderie));
        }
        return $this->render('PIdevAllforkidsBundle:Garderie:galerieAjout.html.twig',array('form'=>$form->createView(),'Garderie'=>$Garderie));
    }


    public function galerieafficheAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
      $Galery=$em->getRepository("PIdevAllforkidsBundle:Galery")->chercher($Garderie);
//        $Galery=$em->getRepository("PIdevAllforkidsBundle:Galery")->findAll();
       return $this->render('PIdevAllforkidsBundle:Garderie:galerieaffiche.html.twig',array("Galery" => $Galery,'Garderie'=>$Garderie));


    }
public function ContactGAction(Request $request)
{
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
    return $this->render('PIdevAllforkidsBundle:Garderie:contactGard.html.twig',array('Garderie'=>$Garderie));


}

    public function AfficheMobileAction()
    {
        $em =$this->getDoctrine()->getManager();
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->findAll();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($Garderie);
        return new JsonResponse($formatted);
    }
    public function DetailGardMobileAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($Garderie);
        return new JsonResponse($formatted);

    }

    public function SupprimerGarderieMOBILAction($id)
    {

        $em=$this->getDoctrine()->getManager();

        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $em->remove($Garderie);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($Garderie);
        return new JsonResponse($formatted);

    }



    public function UpdateGarderieMOBILEAction(Request $request)
    {   $user=1;
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Garderie =$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $Garderie->setUser($user);
        $Garderie->setNom($request->get('nom'));
        $Garderie->setDescription($request->get('description'));
        $Garderie->setEmplacement($request->get('emplacement'));
        $Garderie->setCapacite($request->get('capacite'));
        $Garderie->setNumTel($request->get('numTel'));

        $em->persist($Garderie);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted =$serializer->normalize($Garderie);
        return new JsonResponse($formatted);



    }


}

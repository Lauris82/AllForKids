<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20/02/2018
 * Time: 21:23
 */

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\CompteRedu;
use PIdev\AllforkidsBundle\Entity\CompteRPS;
use PIdev\AllforkidsBundle\Entity\CompteRSC;
use PIdev\AllforkidsBundle\Entity\CompteRTP;
use PIdev\AllforkidsBundle\Form\CompteReduType;
use PIdev\AllforkidsBundle\Form\CompteRPSType;
use PIdev\AllforkidsBundle\Form\CompteRSCType;
use PIdev\AllforkidsBundle\Form\CompteRTPType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PIdev\AllforkidsBundle\Entity\Enfant;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompteReduController extends Controller
{

 public function AjoutCPNourissonAction(Request $request)
 {
     $em = $this->getDoctrine()->getManager();
     $id=$request->get('id');
     $user=$this->get('security.token_storage')->getToken()->getUser();
     $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->find($id);

     if($Enfant->getCategorie()=='Nourrisson')
     {
         $CompteRedu=new CompteRedu();
         $form=$this->createForm(CompteReduType::class,$CompteRedu);
         $form->handleRequest($request);
         $CompteRedu->setUser($user);
         $CompteRedu->setEnfant($Enfant);
         $CompteRedu->setDateCompteRendu(new \DateTime());
         if ($form->isValid()) {
             $em->persist($CompteRedu);
             $em->flush();
             return $this->redirect($this->generateUrl('affiche_enfant'));
         }

         return $this->render('PIdevAllforkidsBundle:CompteRedu:ajouterCompteRNourrisson.html.twig',array('form'=>$form->createView()));

     }
   if ($Enfant->getCategorie()=='Tout Petit')
     {
         $CompteRTP = new CompteRTP();

         $form=$this->createForm(CompteRTPType::class,$CompteRTP);
         $form->handleRequest($request);
         $CompteRTP->setUser($user);
         $CompteRTP->setEnfant($Enfant);
         $CompteRTP->setDateCompteRendu(new \DateTime());
         if ($form->isValid()) {
             $em->persist($CompteRTP);
             $em->flush();
             return $this->redirect($this->generateUrl('affiche_enfant'));
         }

         return $this->render('PIdevAllforkidsBundle:CompteRedu:ajouterCompteRToutPetit.html.twig',array('form'=>$form->createView()));


     }
     if ($Enfant->getCategorie()=='Préscolaire')
     {
         $CompteRPS = new CompteRPS();

         $form=$this->createForm(CompteRPSType::class,$CompteRPS);
         $form->handleRequest($request);
         $CompteRPS->setUser($user);
         $CompteRPS->setEnfant($Enfant);
         $CompteRPS->setDateCompteRendu(new \DateTime());
         if ($form->isValid()) {
             $em->persist($CompteRPS);
             $em->flush();
             return $this->redirect($this->generateUrl('affiche_enfant'));
         }

         return $this->render('PIdevAllforkidsBundle:CompteRedu:ajouterCompteRPresScolaire.html.twig',array('form'=>$form->createView()));

     }
     if ($Enfant->getCategorie()=='Scolaire')
     {
         $CompteRSC = new CompteRSC();

         $form=$this->createForm(CompteRSCType::class,$CompteRSC);
         $form->handleRequest($request);
         $CompteRSC->setUser($user);
         $CompteRSC->setEnfant($Enfant);
         $CompteRSC->setDateCompteRendu(new \DateTime());
         if ($form->isValid()) {
             $em->persist($CompteRSC);
             $em->flush();
             return $this->redirect($this->generateUrl('affiche_enfant'));
         }

         return $this->render('PIdevAllforkidsBundle:CompteRedu:ajouterCompteRScolaire.html.twig',array('form'=>$form->createView()));
     }



 }
 public function AfficheCRNAction(Request $request)
 {
     $em = $this->getDoctrine()->getManager();
     $id=$request->get('id');
     $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->find($id);

     if($Enfant->getCategorie()=='Nourrisson')
     {
         $Compte = $em->getRepository("PIdevAllforkidsBundle:CompteRedu")->TrouverCompte($Enfant);

     $snappy= $this->get("knp_snappy.pdf");
     $html=$this->renderView('PIdevAllforkidsBundle:CompteRedu:AfficheCRN.html.twig', array("Compte" => $Compte, "Enfant" => $Enfant));
     $filename="custom_pdf_from_twig";
     return new Response(
         $snappy->getOutputFromHtml($html),
         200,
         array(
             'Content-Type'=>'application/pdf',
             'Content-Disposition'=>'inline; filename= "'.$filename.'.pdf"'
         )
     );



     }
     if ($Enfant->getCategorie()=='Tout Petit')
     {
         $Compte = $em->getRepository("PIdevAllforkidsBundle:CompteRTP")->TrouverCompte($Enfant);

         $snappy= $this->get("knp_snappy.pdf");
         $html=$this->renderView('PIdevAllforkidsBundle:CompteRedu:AfficheRTP.html.twig', array("Compte" => $Compte, "Enfant" => $Enfant));
         $filename="custom_pdf_from_twig";
         return new Response(
             $snappy->getOutputFromHtml($html),
             200,
             array(
                 'Content-Type'=>'application/pdf',
                 'Content-Disposition'=>'inline; filename= "'.$filename.'.pdf"'
             )
         );
     }
     if ($Enfant->getCategorie()=='Préscolaire')
     {

         $Compte = $em->getRepository("PIdevAllforkidsBundle:CompteRPS")->TrouverCompte($Enfant);


         $snappy= $this->get("knp_snappy.pdf");
         $html=$this->renderView('PIdevAllforkidsBundle:CompteRedu:AfficheRPS.html.twig', array("Compte" => $Compte, "Enfant" => $Enfant));
         $filename="custom_pdf_from_twig";
         return new Response(
             $snappy->getOutputFromHtml($html),
             200,
             array(
                 'Content-Type'=>'application/pdf',
                 'Content-Disposition'=>'inline; filename= "'.$filename.'.pdf"'
             )
         );

     }
     if ($Enfant->getCategorie()=='Scolaire')
     {
         $Compte = $em->getRepository("PIdevAllforkidsBundle:CompteRSC")->TrouverCompte($Enfant);


         $snappy= $this->get("knp_snappy.pdf");
         $html=$this->renderView('PIdevAllforkidsBundle:CompteRedu:AfficheRSC.html.twig', array("Compte" => $Compte, "Enfant" => $Enfant));
         $filename="custom_pdf_from_twig";
         return new Response(
             $snappy->getOutputFromHtml($html),
             200,
             array(
                 'Content-Type'=>'application/pdf',
                 'Content-Disposition'=>'inline; filename= "'.$filename.'.pdf"'
             )
         );

     }


 }




}
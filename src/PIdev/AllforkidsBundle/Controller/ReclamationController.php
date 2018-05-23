<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 15/02/2018
 * Time: 00:05
 */

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\mail;
use PIdev\AllforkidsBundle\Entity\Reclamation;

use PIdev\AllforkidsBundle\Form\mailType;
use PIdev\AllforkidsBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReclamationController extends  Controller
{

        public function EnvoyerRecAction(Request $request){

            $em = $this->getDoctrine()->getManager();

            $us = $this->get('security.token_storage')->getToken()->getUser()->getId();

            $ass=$em->getRepository('PIdevAllforkidsBundle:Association')->findAll();
            $cl=$em->getRepository('PIdevAllforkidsBundle:Club')->findAll();

            $associat=null;
            $clu=null;
            $rec= new Reclamation();
            $form = $this->createForm(ReclamationType::class,$rec);

            if ($form->handleRequest($request)->isSubmitted())
            {
                $associat=$request->get('AName');
                $clu=$request->get('CName');



                if($associat!=null){

                    $rec->setTypeRec("Association");
                    $rec->setMembreRec($associat);
                    $rec->setUser($us);
                    $rec->setEtatRec(1);
                    $em->persist($rec); // insert into table
                    $em->flush(); //executer
                    return $this->redirectToRoute('Home_Page');
                }

                if($clu!=null){


                    $rec->setTypeRec("Club");
                    $rec->setMembreRec($clu);
                    $rec->setUser($us);
                    $rec->setEtatRec(1);
                    $em->persist($rec); // insert into table
                    $em->flush(); //executer
                    return $this->redirectToRoute('Home_Page');
                }

            }

            return $this->render('PIdevAllforkidsBundle:Reclamation:test.html.twig',array("A"=>$ass,"C"=>$cl ,"f"=>$form->createView()));



        }




    public function ListerReclamationAction(){

            $n=1;
            $a=0;
        $em=$this->getDoctrine()->getManager();
        $recs=$em->getRepository('PIdevAllforkidsBundle:Reclamation')->findR($n);

        $Nbr=$em->getRepository('PIdevAllforkidsBundle:Reclamation')->NbrR($n);
        $Nb=$em->getRepository('PIdevAllforkidsBundle:Reclamation')->NbrR($a);


        return $this->render('PIdevAllforkidsBundle:Reclamation:ListerReclamation.html.twig',array("R"=>$recs,"m"=>$Nbr,"a"=>$Nb));
    }





    public function ArchiverReclamationAction($id,$x,Request $request){



        $mail = new mail();
        $form = $this->createForm(mailType::class, $mail);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Reclamation traitée')
                ->setFrom('espritplus2017@gmail.com')
                ->setTo($x)
                ->setBody($this->renderView('PIdevAllforkidsBundle:Mail:email.html.twig',
                    array('nom' => $mail->getNom(),
                        'prenom' => $mail->getPrenom())),
                    'text/html');
            $mail->setEmail($x);
            $mail->setTel(23076477);
            $mail->setNom("user");
            $mail->setPrenom("user");
            $mail->setText("confirmation");
            $this->get('mailer')->send($message);


            $em=$this->getDoctrine()->getManager();
            $Rec=$em->getRepository('PIdevAllforkidsBundle:Reclamation')->find($id);

            $Rec->setEtatRec(0);
            $em->persist($Rec);
            $em->flush();


            return $this->redirectToRoute('Lister_Reclamations');
        }
        return $this->render('PIdevAllforkidsBundle:Mail:Mail.html.twig', array('form' => $form->createView()));

    }


/*public function ArchiverReclamationAction($id,Request $request){

    $em=$this->getDoctrine()->getManager();
    $Rec=$em->getRepository('PIdevAllforkidsBundle:Reclamation')->find($id);

        $Rec->setEtatRec(0);
        $em->persist($Rec);
        $em->flush();
        return $this->redirectToRoute('Lister_Reclamations');






}*/



    public function AdminHomeAction(){

        return $this->render('PIdevAllforkidsBundle:Reclamation:AdminHome.html.twig');
    }


    public function testAction(Request $request)
    {
        /*$rec = new Reclamation();
        $form= $this->createForm(ReclamationType::class,$rec);
        $form->handleRequest($request) ;
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('espritplus2017@gmail.com')
                ->setTo($rec->getEmail())
                ->setBody(
                    $this->renderView('PIdevAllforkidsBundle:Reclamation:email.html.twig', array('nom' => $rec->getNom(), 'prenom'=>$rec->getPrenom())),
                    'text/html');
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }

        return $this->render('PIdevAllforkidsBundle:Reclamation:rec.html.twig',
            array('form'=>$form->createView()));*/




        $form = $this->createFormBuilder()
            ->add('from', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
        ->getForm()
    ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ourFormData = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact Form Submission')
                ->setFrom($form->getData()['from'])
                ->setTo('chaiebyasmine2@gmail.com')
                ->setBody(
                    $form->getData()['message'],
                    'text/plain'
                )
            ;

            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }

        return $this->render('PIdevAllforkidsBundle:Reclamation:rec.html.twig', [
            'form' => $form->createView(),
        ]);


    }


    public function successAction()
    {
        return new Response("email envoyé avec succès, Merci de vérifier votre boitemail.");

    }



    public function envoyerAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $rec=new Reclamation();
        $rec->setObjetRec($request->get('objet'));
        $rec->setMail($request->get('mail'));
        $rec->setContenuRec($request->get('contenu'));
        $rec->setEtatRec(1);
        $em->persist($rec);
        $em->flush();
        $serialiser=new Serializer([new ObjectNormalizer()]);
        $formatted=$serialiser->normalize($rec);
        return new JsonResponse($formatted);

    }


}
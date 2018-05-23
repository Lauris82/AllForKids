<?php

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Notification;
use PIdev\AllforkidsBundle\Entity\ReservationTransport;
use PIdev\AllforkidsBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationTransportController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function reserveroffreAction(Request $request){
        $id = $request->get('id');

        $modele = new ReservationTransport();
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PIdevAllforkidsBundle:User')->find($us)->getId();

        $modele2 = $em->getRepository('PIdevAllforkidsBundle:User')->find($us);
        $modele21 = $em->getRepository('PIdevAllforkidsBundle:User')->find($us)->getNom();
        $modele3 = $em->getRepository('PIdevAllforkidsBundle:OffreTransport')->find($id);

        $existe = $em->getRepository('PIdevAllforkidsBundle:ReservationTransport')->verifierReservation($user, $id);

        if ($existe == null) {

            $dest = $modele3->getUser();
            $dest1 = $em->getRepository('PIdevAllforkidsBundle:User')->find($dest);
            $dest1->setNotification($dest1->getNotification()+1);

            $modele->setUser($modele2);
            $modele->setOffreTransport($modele3);
            $modele->setDateReservation(new \DateTime('now'));
            $modele->setNombreEnfants(1);
            $modele3->setPlaceRestant($modele3->getPlaceRestant()-1);
            $em->persist($modele);
            $em->flush();

            $notif = new NotificationController();
            $notification = $notif->createNotificationAction($modele2, $modele3->getUser(), null, $modele, "Votre offre a été reserver par $modele21");
            $em->persist($notification);
            $em->flush();

        }

        return $this->redirectToRoute('Liste_Reservation_OffreTransport');
    }

    public function dereserveroffreAction(Request $request){
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("PIdevAllforkidsBundle:ReservationTransport")->find($id);

        $offre = $reservation->getOffreTransport();
        $offre1 = $em->getRepository("PIdevAllforkidsBundle:OffreTransport")->find($offre);
        $offre1->setPlaceRestant($offre1->getPlaceRestant()+1);

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('Liste_Reservation_OffreTransport');
    }

    public function listereservationAction(){
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("PIdevAllforkidsBundle:ReservationTransport")->findAll();
        return $this->render('PIdevAllforkidsBundle:ReservationTransport:ListeReservation.html.twig',array('reservation'=>$reservation));
    }

}

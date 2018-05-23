<?php

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function createNotificationAction($emetteur, $destinataire, $message, $reservation, $sujet){
        $notification = new Notification();

        $notification->setEmetteur($emetteur);
        $notification->setDateNotification(new \DateTime('now'));
        $notification->setDestinataire($destinataire);
        $notification->setMessage($message);
        $notification->setReservation($reservation);
        $notification->setSujet($sujet);

        return $notification;
    }

    public function listeNotificationAction(){
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository('PIdevAllforkidsBundle:Notification')->trieNotification();

        $this->reinitialiserNotificationAction();

        return $this->render('PIdevAllforkidsBundle:Notification:ListeNotification.html.twig', array("notif"=>$notif));
    }

    public function reinitialiserNotificationAction(){
        $em = $this->getDoctrine()->getManager();
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $user = $em->getRepository('PIdevAllforkidsBundle:User')->find($us);

        $n = $user->getNotification();

        if ($n != null){
            $user->setNotification(null);
        }
        $em->flush();
    }

}

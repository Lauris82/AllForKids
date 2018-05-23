<?php

namespace PIdev\ApiBundle\Controller;

use PIdev\AllforkidsBundle\Entity\ReservationTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Reservation_Controller extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function addReservationAction(Request $request){
        $resv = new ReservationTransport();
        $em = $this->getDoctrine()->getManager();

        $resv->setUser($request->get('user'));
        $resv->setNombreEnfants(1);
        $resv->setDateReservation($request->get('date_reservation'));
        $resv->setOffreTransport($request->get('offreTransport'));

        $em->persist($resv);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($resv);
        return new JsonResponse($formatted);
    }


    public function allReservationAction(){
        $offer = $this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:ReservationTransport')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($offer);

        return new JsonResponse($formatted);
    }
}

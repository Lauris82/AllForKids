<?php

namespace PIdev\AllforkidsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReservationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function reserverevenementAction(Request $request)
    {
        $id = $request->get('id');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $usr = $em->getRepository('PIdevAllforkidsBundle:User')->find($user)->getId();


        $existe = $em->getRepository('PIdevAllforkidsBundle:Reservation')->reservation($usr, $id);
        if ($existe == null) {

            $sql = "INSERT INTO `reservation`(`date_reservation`, `reservation_user`, `evenement_reservation`) VALUES (CURRENT_DATE(),$usr,$id)";
            $em->getConnection()->prepare($sql)->execute();

            return $this->redirectToRoute('detail_evenement', array('id' => $id));


        } else {

            return $this->redirectToRoute('list_evenement', array('id' => $id));
        }

    }

    public function listreservationAction(Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository("PIdevAllforkidsBundle:Reservation")->membresEvenement($id);
        return $this->render('PIdevAllforkidsBundle:Reservation:membresEvenement.html.twig', array('membres' => $membres));
    }

    public function listreservationBackAction(Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository("PIdevAllforkidsBundle:Reservation")->membresEvenement($id);
        return $this->render('PIdevAllforkidsBundle:ReservationBack:membresEvenementBack.html.twig', array('membres' => $membres));
    }
    public function dereserverAction(Request $request)
    {
        $id = $request->get('id');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $usr = $em->getRepository('PIdevAllforkidsBundle:User')->find($user)->getId();
        $reservation = $em->getRepository('PIdevAllforkidsBundle:Reservation')->reservation($usr, $id);
        if ($reservation != null) {

            foreach ($reservation as $x) {

                $em->remove($x);
                $em->flush();
                return $this->redirectToRoute('detail_evenement', array('id' => $id));
            }

        } else

            return $this->redirectToRoute('detail_evenement', array('id', $id));
    }

    public function annulerReservAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('PIdevAllforkidsBundle:Reservation')->find($id);
        $event = $reservation->getEvenement()->getId_evenement();
        if ($reservation != null) {

            $em->remove($reservation);
            $em->flush();


            return $this->redirectToRoute('membre_evenement', array('id' => $event));
        } else
            return $this->redirectToRoute('membre_evenement', array('id' => $event));


}




//mobile
public function estReserverMobileAction(Request $request)
{
    $idu = $request->get('idu');
    $ide = $request->get('ide');
    $em = $this->getDoctrine()->getManager();
    $reservation = $em->getRepository('PIdevAllforkidsBundle:Reservation')->reservation($idu, $ide);
    if ($reservation == null) {
        $existe =false ;
    }else{
        $existe=true ;
    }
    $serializer = new Serializer(array(new ObjectNormalizer()));
    $data = $serializer->normalize($existe);
    return new JsonResponse($data);
}
    public function reserverevenementMobileAction(Request $request)
    {
        $ide = $request->get('ide');
        $idu = $request->get('idu');
        $em = $this->getDoctrine()->getManager();

            $sql = "INSERT INTO `reservation`(`date_reservation`, `reservation_user`, `evenement_reservation`) VALUES (CURRENT_DATE(),$idu,$ide)";
            $em->getConnection()->prepare($sql)->execute();

        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize("reservation ajouter");
        return new JsonResponse($data);

    }
    public function dereserverMobileAction(Request $request)
    {
        $ide = $request->get('ide');
        $idu = $request->get('idu');
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('PIdevAllforkidsBundle:Reservation')->reservation($idu, $ide);
        if ($reservation != null) {

            foreach ($reservation as $x) {

                $em->remove($x);
                $em->flush();
            }

        }
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize("reservation supprimer");
        return new JsonResponse($data);
    }

    public function membreEvenementMobileAction(Request $request)
    {
        $ide = $request->get('ide');
        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository("PIdevAllforkidsBundle:Reservation")->membresEvenement($ide);
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize($membres);

        return new JsonResponse($data);
    }
    public function compteNbrReservationMobileAction(Request $request)
    {
        $ide = $request->get('ide');
        $em = $this->getDoctrine()->getManager();
        $nbr = $em->getRepository("PIdevAllforkidsBundle:Reservation")->compteNbrReservation($ide);
        foreach ($nbr as $x)
        {
            $n=$x;
        }
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize($n);

        return new JsonResponse($data);
    }
}
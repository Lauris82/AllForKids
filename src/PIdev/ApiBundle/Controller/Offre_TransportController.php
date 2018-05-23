<?php

namespace PIdev\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Offre_TransportController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function allOffersAction(){
        $offer = $this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:OffreTransport')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($offer);

        return new JsonResponse($formatted);
    }
}

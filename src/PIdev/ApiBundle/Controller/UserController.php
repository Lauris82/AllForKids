<?php

namespace PIdev\ApiBundle\Controller;

use PIdev\AllforkidsBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function allUserAction(){
        $user = $this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:User')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);

        return new JsonResponse($formatted);
    }


    public function findUserAction($id){
        $user = $this->getDoctrine()->getManager()->getRepository('PIdevAllforkidsBundle:User')->find($id);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);

        return new JsonResponse($formatted);
    }


    public function addUser(Request $request){
        $user = new User();
        $em = $this->getDoctrine()->getManager();

        $user->setUsername($request->get('username'));
        $user->setUsernameCanonical($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setEmailCanonical($request->get('email'));
        $user->setEnabled(1);
        $user->setPassword($request-$this->get('password'));
        $user->setRoles($request->get('roles'));
        $user->setNom($request->get('nom'));
        $user->setPrenom($request->get('prenom'));
        $user->setDateNaissance($request->get('date_naissance'));
        $user->setAdresse($request->get('adresse'));
        $user->setImage($request->get('image'));

        $em->persist($user);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

}

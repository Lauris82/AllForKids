<?php

namespace PIdev\AllforkidsBundle\Controller;


use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use PIdev\AllforkidsBundle\Entity\Evenement;
use PIdev\AllforkidsBundle\Entity\User;
use PIdev\AllforkidsBundle\Form\EvenementType;
use PIdev\AllforkidsBundle\Form\RechercheEvenementAjaxForm;
use PIdev\AllforkidsBundle\PIdevAllforkidsBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class EvenementController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function ajoutevenementAction(Request $request)
    {
        $Evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ev = $em->getRepository('PIdevAllforkidsBundle:User')->find($user);
            $Evenement->setUser($ev);
            $Evenement->setNbrPlace(50);
            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('list_evenement');
        }
        return $this->render('PIdevAllforkidsBundle:Evenement:ajout.html.twig', array("form" => $form->createView()));
    }


    public function detailvenementAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("PIdevAllforkidsBundle:Evenement")->findBy(array('id_evenement' => $id));

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $ev = $em->getRepository('PIdevAllforkidsBundle:User')->find($user);
        $userReserv = $em->getRepository('PIdevAllforkidsBundle:Reservation')->userReserv($ev->getId(), $id);
        if ($userReserv == null) {
            $reserv = false;

        } else {
            $reserv = true;
        }
        dump($reserv);
        // return $this->render("PIdevAllforkidsBundle:Evenement:t.html.twig");
        return $this->render("PIdevAllforkidsBundle:Evenement:detail.html.twig", array('evenement' => $evenement, 'reserv' => $reserv, 'user' => $ev));
    }


    public function affichevenementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $arch = $em->getRepository("PIdevAllforkidsBundle:Evenement")->anciensEvenements();  //archiver les èvenement that date_fin <currentDate()

        foreach ($arch as $a) {
            $a->setEtat(1);

            $em->flush();
        }
        $eventtous = $em->getRepository("PIdevAllforkidsBundle:Evenement")->toutesEvenements();


        $evenement = new Evenement();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PIdevAllforkidsBundle:Evenement')->toutesEvenements();
        $form = $this->createForm(RechercheEvenementAjaxForm::class, $evenement);
        $form->handleRequest($request);
        if ($request->isMethod("post")) {

            $nom = $request->get('nommm');

            $event = $em->getRepository('PIdevAllforkidsBundle:Evenement')->RechercheEvenements($nom);

            $serializer = new Serializer(array(new ObjectNormalizer()));
            $data = $serializer->normalize($event);
            //     $eventtous = null;

            return new JsonResponse($data);

        }

//return $this->render('PIdevAllforkidsBundle:Evenement:t.html.twig');
        return $this->render("PIdevAllforkidsBundle:Evenement:list.html.twig", array('form' => $form->createView(), 'evenement' => $event, 'evenementt' => $eventtous));
    }

    public function rechercheevenementBackAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository("PIdevAllforkidsBundle:Evenement")->anciensEvenements();
        foreach ($ev as $a) {
            $a->setEtat(1);

            $em->flush();
        }
        if ($request->isMethod("post")) {
            $nom = $request->get('nom');

            $evenement = $em->getRepository('PIdevAllforkidsBundle:Evenement')->findBy(array('nom' => $nom));
        } else
            $evenement = null;
        return $this->render('PIdevAllforkidsBundle:EvenementBack:Recherche.html.twig', array('evenement' => $evenement));
    }

    public function modifierevenementAction(Request $request)
    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository('PIdevAllforkidsBundle:Evenement')
            ->find($id);
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('list_evenement');
        }
        return $this->render("PIdevAllforkidsBundle:Evenement:update.html.twig", array("form" => $form->createView()));
    }

    public function supprimerevenementAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("PIdevAllforkidsBundle:Evenement")->find($id);
        $z = date_diff(new \DateTime(), $evenement->getDateDebut());
        if ($z->days == 0) {
            return $this->redirectToRoute('list_evenement');
        } else {
            $evenement->setEtat(1);

            $em->flush();
            //  return $this->redirectToRoute('list_evenement');
            return $this->redirectToRoute('list_evenement');
        }


    }

//partie back
    public function afficheBackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ev = $em->getRepository("PIdevAllforkidsBundle:Evenement")->anciensEvenements();
        foreach ($ev as $a) {
            $a->setEtat(1);

            $em->flush();
        }
        $evenement = $em->getRepository("PIdevAllforkidsBundle:Evenement")->findAll();
        return $this->render('PIdevAllforkidsBundle:EvenementBack:list.html.twig', array('evenement' => $evenement));

    }


    public function supprimerevenementBackAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("PIdevAllforkidsBundle:Evenement")->find($id);
        $z=date_diff(new \DateTime(),$evenement->getDateDebut());

        if($z->days==0){

            return $this->redirectToRoute('list_evenement_back');
        }else{
            $evenement->setEtat(1);

            $em->flush();

            return $this->redirectToRoute('list_evenement_back');
        }

    }
    //mobile

    public function ajoutevenementMobileAction(Request $request)
    {
        $Evenement = new Evenement();
            $em = $this->getDoctrine()->getManager();
            $user=$em->getRepository('PIdevAllforkidsBundle:User')->findOneBy(array('id'=>$request->get('user')));
            $Evenement->setNom($request->get('nom'));
        $Evenement->setDescription($request->get('desc'));
        $Evenement->setEmplacement($request->get('emp'));
        $Evenement->setDateDebut(new \DateTime($request->get('dateD')));
        $Evenement->setDateFin(new \DateTime($request->get('dateF')));
        $Evenement->setImage($request->get('img'));
       $Evenement->setNbrPlace($request->get('nbrP'));
        $Evenement->setUser($user);
        $Evenement->setEtat(0);

            $em->persist($Evenement);
            $em->flush();
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize($Evenement);
        return new JsonResponse($data);
    }

    public function affichevenementMobileAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $arch = $em->getRepository("PIdevAllforkidsBundle:Evenement")->anciensEvenements();
        foreach ($arch as $a) {
            $a->setEtat(1);

            $em->flush();
        }
        $eventtous = $em->getRepository("PIdevAllforkidsBundle:Evenement")->toutesEvenements();

        $serializer = new Serializer(array(new ObjectNormalizer()));
            $data = $serializer->normalize($eventtous);

            return new JsonResponse($data);

    }
    public function modifierenementMobileAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $user=$em->getRepository('PIdevAllforkidsBundle:User')->findOneBy(array('id'=>$request->get('user')));
        $Evenement = $em->getRepository('PIdevAllforkidsBundle:Evenement')
            ->find($id);
        $Evenement->setNom($request->get('nom'));
        $Evenement->setDescription($request->get('desc'));
        $Evenement->setEmplacement($request->get('emp'));
        $Evenement->setDateDebut(new \DateTime($request->get('dateD')));
        $Evenement->setDateFin(new \DateTime($request->get('dateF')));
        $Evenement->setImage($request->get('img'));
        $Evenement->setNbrPlace($request->get('nbrP'));
        $Evenement->setUser($user);
        $Evenement->setEtat(0);

        $em->persist($Evenement);
        $em->flush();
        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize($Evenement);
        return new JsonResponse($data);
    }
    public function supprimerevenementMobileAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("PIdevAllforkidsBundle:Evenement")->find($id);
            $evenement->setEtat(1);
            $em->flush();


        $serializer = new Serializer(array(new ObjectNormalizer()));
        $data = $serializer->normalize("evenement supprimer");
        return new JsonResponse($data);

    }


}
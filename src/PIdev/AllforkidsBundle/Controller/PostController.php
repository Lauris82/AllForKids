<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 13/02/2018
 * Time: 00:42
 */

namespace PIdev\AllforkidsBundle\Controller;


use PIdev\AllforkidsBundle\Entity\Post;
use PIdev\AllforkidsBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;

class PostController extends Controller
{
    public function addAction(Request $request){

        $post = new Post();
        $user = $this->getUser();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isValid())
        {


            $em = $this->getDoctrine()->getManager();

            $post->setCreatedAt(new \DateTime());
            $post->setUser($user);

            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('Page_post_affiche'));
        }
        return $this->render('PIdevAllforkidsBundle:post:add.html.twig', array('form' => $form->createView()));
    }



    public function listAction(){

        $em=$this->getDoctrine()->getManager();
        $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findBy( ['nmbrsignal' =>  array(0,1,2)]);

        return $this->render('PIdevAllforkidsBundle:post:affichagepost.html.twig',array('Posts'=>$posts));



    }
    public function listidAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository("PIdevAllforkidsBundle:Post")->findBy(array('id_post'=>$id));
        return ($this->render("PIdevAllforkidsBundle:post:affichageid.html.twig"
            ,array('Posts'=>$posts)
        ));
    }
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($id);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("Page_post_affiche");
        }
        return $this->render("@PIdevAllforkids/post/update.html.twig"
            , array('form' => $form->createView())
        );

    }
    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $post=$em->getRepository('PIdevAllforkidsBundle:Post')->find($id);
        $commentaire=$em->getRepository('PIdevAllforkidsBundle:Commentaire')->findBypost($id);
        foreach ($commentaire as $c){$em->remove($c);}

        $em->remove($post);
        $em->flush();
        return($this->redirectToRoute('Page_post_affiche'));

    }

    public function rechercheAction(\Symfony\Component\HttpFoundation\Request $request){

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findAll();
        if($request->isMethod('POST')){
            $critere =$request->get('titre');
            $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findBy(array('titre'=>$critere));
        }
        return $this->render('PIdevAllforkidsBundle:post:affichagepost.html.twig',array('Posts'=>$posts));
    }

    public function SearchAction(Request $request){
       $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findAll();
        if($request->isMethod('POST')){
            $critere =$request->get('search');

            $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findPostByTitle($critere);
        }
        return $this->render('PIdevAllforkidsBundle:post:affichagepost.html.twig',array('Posts'=>$posts));




    }
    public function liveSearchAction(Request $request)
    {

        $req = $request->request->get('q');

        $em = $this->getDoctrine()->getManager();
        $modules = $em->getRepository('PIdevAllforkidsBundle:Post')->findPostByTitle($req);


        return new JsonResponse($modules);
    }
    public function listBackAction(){

        $em=$this->getDoctrine()->getManager();
        $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findAll();

        return $this->render('PIdevAllforkidsBundle:postBack:affichagepostBack.html.twig',array('Posts'=>$posts));



    }
    public function deleteBackAction($id){

        $em=$this->getDoctrine()->getManager();
        $post=$em->getRepository('PIdevAllforkidsBundle:Post')->find($id);
        $commentaire=$em->getRepository('PIdevAllforkidsBundle:Commentaire')->findBypost($id);
        foreach ($commentaire as $c){$em->remove($c);}

        $em->remove($post);
        $em->flush();
        return($this->redirectToRoute('Page_post_affiche_back' ));

    }





}
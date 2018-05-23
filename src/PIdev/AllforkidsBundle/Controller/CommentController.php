<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 13/02/2018
 * Time: 17:26
 */

namespace PIdev\AllforkidsBundle\Controller;


use PIdev\AllforkidsBundle\Entity\Commentaire;
use PIdev\AllforkidsBundle\Entity\Post;
use PIdev\AllforkidsBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function addAction(Request $request,$id){

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $post = new  Post();
        $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($id);
$o=$em->getRepository("PIdevAllforkidsBundle:Commentaire")->findBy(array('post'=>$post));
        $c=$em->getRepository("PIdevAllforkidsBundle:Commentaire")->findBypost($id);

        $comment = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $comment->setCreatedAt(new \DateTime());
            $comment->setUser($user);
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('Page_comment_affiche',array('Comment'=>$c,'post'=>$post,'o'=>$o,'id'=>$id));

        }
        return $this->render('PIdevAllforkidsBundle:commentaire:add.html.twig', array(

            'form' => $form->createView(),'post'=>$post
        ));
    }
        public function listcommentAction($id){
        //instantier l'entity manager

            $em=$this->getDoctrine()->getManager();
            $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($id);
            $comment = $em->getRepository('PIdevAllforkidsBundle:Commentaire')->findBy(array('post'=>$post->getIdPost()));
            $o=$em->getRepository("PIdevAllforkidsBundle:Commentaire")->findBy(array('post'=>$post));

            return $this->render('PIdevAllforkidsBundle:commentaire:affichagecomment.html.twig',array('Comment'=>$comment,'post'=>$post,'o'=>$o));

        //return $this->render('parcAutomobileEspritParcBundle:Modele:list.html.twig', array('modeles' => $modeles));

    }

    public function updatecommentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository("PIdevAllforkidsBundle:Commentaire")->find($id);

        $postt = $commentaire->getPost()->getIdPost();
        $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($postt);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->flush();

            return $this->redirectToRoute("Page_comment_affiche",array('id'=>$postt));

        }


        return $this->render("PIdevAllforkidsBundle:commentaire:update.html.twig",array('form' => $form->createView(),'post'=>$post)
        );

    }

    public function deletecommentAction($id_commentaire)
    {

        $em = $this->getDoctrine()->getManager();

        $comment = $em->getRepository("PIdevAllforkidsBundle:Commentaire")->findOneBy(array('id_commentaire'=>$id_commentaire));

        $id= $comment->getPost()->getIdPost();

        $em->remove($comment);
        $em->flush();
       return $this->redirectToRoute("Page_comment_affiche", array('id'=>$id));
//return $this->render('PIdevAllforkidsBundle:commentaire:t.html.twig');

    }



}
<?php

namespace PIdev\AllforkidsBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use PIdev\AllforkidsBundle\Entity\Aime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AimeController extends Controller
{
    public function LikeAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $aime = new  Aime();
        if($request->isMethod('POST')) {
            $id=$request->get('id');
            $test=$em->getRepository('PIdevAllforkidsBundle:Aime')->findBy(array('idPost'=>$id,'idUser'=>$user));
            $p=count($test);
            $likedPost = $em->getRepository("PIdevAllforkidsBundle:Aime")->findOneBy(array('idPost'=>$id));
            $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($id);

            if ( $likedPost == NULL){

                $aime->setIdPost($post->getIdPost());
                $aime->setIdUser($this->getUser());
                $aime->setNbLike(1);
                $em->persist($aime);
                $em->flush();

            }else{
                if($p ==0){
              //  echo  $likedPost->getNbLike(); exit(0);
                $likedPost->setNbLike($likedPost->getNbLike()+1);
                $em->flush();}
                else{
                    die('deja aimé');
                }
            }


        }

       // $posts = $em->getRepository('PIdevAllforkidsBundle:Post')->findAll();
        //return $this->render('PIdevAllforkidsBundle:post:affichagepost.html.twig',array('Posts'=>$posts));
   return $this->redirectToRoute('Page_post_affiche');
    }

    public function aimepostAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $aimes = $em->getRepository(Aime::class)->findAll();
        $totalaime=0;
        foreach($aimes as $aime) {
        $totalaime=$totalaime+$aime->getNbLike();
        }
        $data= array();
        $stat=['aime', 'nbLike'];
        $nb=0;
        array_push($data,$stat);
        foreach($aimes as $aime) {
            $stat=array();
            array_push($stat,$aime->getIdPost(),(($aime->getNbLike()) *100)/$totalaime);
            $nb=($aime->getNbLike() *100)/$totalaime;
            $stat=[$aime->__toString(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des j\'aimes par post');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('PIdevAllforkidsBundle:Default:index.html.twig', array('piechart' =>
            $pieChart));
        }
}


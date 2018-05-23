<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 26/02/2018
 * Time: 13:25
 */

namespace PIdev\AllforkidsBundle\Controller;


use PIdev\AllforkidsBundle\Entity\Signaler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class signaleController extends Controller
{
    public function addsignalAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $signal = new Signaler();

            $test = $em->getRepository('PIdevAllforkidsBundle:Signaler')->findBy(array('idPost' => $id, 'idUser' => $user));
            $p = count($test);
            $signalPost = $em->getRepository("PIdevAllforkidsBundle:Signaler")->findBy(array('idPost' => $id));
            $post = $em->getRepository("PIdevAllforkidsBundle:Post")->find($id);

            if ($p==0) {
                $signal->setIdPost($post);
                $signal->setIdUser($this->getUser());
                $signal->setNbsignal(1);
                $em->persist($signal);

                $signalPost = $em->getRepository("PIdevAllforkidsBundle:Signaler")->findBy(array('idPost' => $id));
                $post->setNmbrsignal($post->getNmbrsignal()+1);
                $s=count($signalPost);
           /*     if ($s > 1)
                {
                   $em->createQuery('DELETE FROM PIdevAllforkidsBundle:Post p WHERE p.id_post= :id')
                       ->setParameter('id',$id)->getResult();
                }
*/
                $em->persist($post);
                $em->flush();
            }
            else
                {
                die('deja signale');
                }


                return $this->redirectToRoute('Page_post_affiche');



        }
}
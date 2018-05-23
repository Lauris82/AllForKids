<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/02/2018
 * Time: 00:03
 */

namespace PIdev\AllforkidsBundle\Controller;
use PIdev\AllforkidsBundle\Entity\Enfant;
use PIdev\AllforkidsBundle\Entity\Garderie;
use PIdev\AllforkidsBundle\Entity\ListeAtt;
use PIdev\AllforkidsBundle\Entity\User;
use PIdev\AllforkidsBundle\Form\EnfantType;
use PIdev\AllforkidsBundle\Form\ListeAttType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EnfantController extends Controller
{
    public function affiche_enfantAction()
    {
        $em =$this->getDoctrine()->getManager();
        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->findAll();


        return $this->render('PIdevAllforkidsBundle:Enfant:affiche_enfant.html.twig',array("Enfant" => $Enfant));
    }
    public function affiche_enfantAdminAction()
    {
        $em =$this->getDoctrine()->getManager();
        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->findAll();


        return $this->render('PIdevAllforkidsBundle:Enfant:affiche_enfant_admin.html.twig',array("Enfant" => $Enfant));
    }
    public function SupprimerEnfantAction(Request $request)
    {
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->find($id);
        $em->remove($Enfant);
        $em->flush();
        return $this->redirectToRoute('ListeGarderie');

    }
    public function SupprimerEnfantAAction(Request $request)
    {
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->find($id);
        $em->remove($Enfant);
        $em->flush();
        return $this->redirectToRoute('affiche_enfant_admin');

    }


    public function UpdateEnfantAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Enfant =$em->getRepository("PIdevAllforkidsBundle:Enfant")->findOneBy(array('id_enfant'=>$id));

        $form=$this->createForm(EnfantType::class,$Enfant);
        $form->handleRequest($request);
        $user=$this->get('security.token_storage')->getToken()->getUser();
        //$Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->findOneBy(array('id_garderie'=>$id));
       // $Enfant->setUser($user);
     // $Enfant->setGarderie($Garderie);
        if ($form->isValid()) {
            $Enfant->uploadProfilPicture();
            $em->persist($Enfant);
            $em->flush();
            return $this->redirect($this->generateUrl('affiche_enfant'));
        }
        return $this->render('PIdevAllforkidsBundle:Enfant:updateEnfant.html.twig',array('form'=>$form->createView()));
    }
    public function AjouterEnfantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $nb=$em->getRepository('PIdevAllforkidsBundle:Enfant')->CalculerNbrEnfant($Garderie);
        if ($nb < $Garderie->getCapacite() )
        {

            $Enfant = new Enfant();
            $form = $this->createForm(EnfantType::class, $Enfant);
            $form->handleRequest($request);


            $Enfant->setUser($user);
            $Enfant->setGarderie($Garderie);

            if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $Enfant->uploadProfilPicture();
                    $em->persist($Enfant);
                $em->flush();
               return $this->redirect($this->generateUrl('ListeGarderie'));



            }
            return $this->render('PIdevAllforkidsBundle:Enfant:ajouterEnfant.html.twig', array('form' => $form->createView()));
        }
        else
        {

            $ListeAtt =new ListeAtt();
            $form = $this->createForm(ListeAttType::class, $ListeAtt);
            $form->handleRequest($request);
            $ListeAtt->setUser($user);
            $ListeAtt->setGarderie($Garderie);
            $ListeAtt->setDate(new \DateTime());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ListeAtt);
                $em->flush();
                return $this->redirect($this->generateUrl('ListeGarderie'));

            }
        }
        return $this->render('PIdevAllforkidsBundle:Enfant:AjoutListeAttente.html.twig', array('form' => $form->createView()));

    }
public function RechercheEnfantAction(Request $request)
{
    $em =$this->getDoctrine()->getManager();
    $id=$request->get('id');
    $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
    $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->chercherEnfants($Garderie);
    if ($request->isMethod('POST'))
    {
        $nom= $request->get('nom');

        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->trouver($nom,$Garderie);

    }
    return $this->render('PIdevAllforkidsBundle:Enfant:rechercheEnfant.html.twig',array('Enfant'=>$Enfant));

}
public function RechercheEnfantCatAction(Request $request)
{
    $em=$this->getDoctrine()->getManager();
    $id=$request->get('id');
    $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
//    $Enfant =$em->getRepository("PIdevAllforkidsBundle:Enfant")->findAll();
    $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->chercherEnfants($Garderie);
    if ($request->isMethod('POST'))
    {
        $categorie= $request->get('categorie');
        $Enfant=$em->getRepository("PIdevAllforkidsBundle:Enfant")->trouver2($categorie,$Garderie);

    }
    return $this->render('PIdevAllforkidsBundle:Enfant:rechercheEnfantCat.html.twig',array('Enfant'=>$Enfant));
}
public function AfficheListeAttenteAction(Request $request)
{
    $em =$this->getDoctrine()->getManager();
    $id=$request->get('id');
    $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);

    $ListeAtt=$em->getRepository("PIdevAllforkidsBundle:ListeAtt")->chercher($Garderie);

    return $this->render('PIdevAllforkidsBundle:Enfant:afficheListeAtt.html.twig',array("ListeAtt" => $ListeAtt));

}
    public function AfficheEnfantsdeGardIAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();
        $id=$request->get('id');
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);

        $Enfants=$em->getRepository("PIdevAllforkidsBundle:Enfant")->chercherEnfants($Garderie);


        return $this->render('PIdevAllforkidsBundle:Enfant:AfficheEnfantsdeGardI.html.twig',array("Enfants" => $Enfants));

    }
    public function RafrechirListeAction(Request $request)
    {
        $id=$request->get('id');

        $em=$this->getDoctrine()->getManager();

        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);

        $ListeAtt=$em->getRepository("PIdevAllforkidsBundle:ListeAtt")->AncienEnfantDansListe($Garderie);
        if($ListeAtt != null) {


            foreach ($ListeAtt as $ll) {
                $em->remove($ll);
                $em->flush();
            }
        }

        return $this->redirectToRoute('ListeGarderie');

    }
public function SupprimerDeListeAction (Request $request)
{
    $id=$request->get('id');
    $em=$this->getDoctrine()->getManager();
    $Liste=$em->getRepository("PIdevAllforkidsBundle:ListeAtt")->find($id);
    $em->remove($Liste);
    $em->flush();
    return $this->redirectToRoute('ListeGarderie');
}

    public function AjouterEnfantMOBILEAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');
        $Garderie=$em->getRepository("PIdevAllforkidsBundle:Garderie")->find($id);
        $user=1;
        $nb=$em->getRepository('PIdevAllforkidsBundle:Enfant')->CalculerNbrEnfant($Garderie);
        if ($nb < $Garderie->getCapacite() )
        {

            $Enfant = new Enfant();



            $Enfant->setUser($user);
            $Enfant->setGarderie($Garderie);
            $Enfant->setNom($request->get('nom'));
            $Enfant->setPrenom($request->get('prenom'));
            $Enfant->setDateNaissance($request->get('dateNaissance'));
            $Enfant->setCategorie($request->get('categorie'));
            $Enfant->setSexe($request->get('sexe'));;
            $em->persist($Enfant);
            $em->flush();

            $serializer= new Serializer([new ObjectNormalizer()]);
            $formatted =$serializer->normalize($Garderie);
            return new JsonResponse($formatted);

        }
        //return $this->render('PIdevAllforkidsBundle:Enfant:ajouterEnfant.html.twig', array('form' => $form->createView()));

        else
        {

            $ListeAtt =new ListeAtt();

            $ListeAtt->setUser($user);
            $ListeAtt->setGarderie($Garderie);
            $ListeAtt->setDate(new \DateTime());
            $ListeAtt->setPrenom($request->get('prenom'));
            $ListeAtt->setNomEnfant($request->get('nom'));
            $ListeAtt->set($request->get('nom'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($ListeAtt);
            $em->flush();

            $serializer= new Serializer([new ObjectNormalizer()]);
            $formatted =$serializer->normalize($Garderie);
            return new JsonResponse($formatted);
        }



    }


}
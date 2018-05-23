<?php

namespace PIdev\AllforkidsBundle\Controller;

use PIdev\AllforkidsBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class CalendarController extends Controller
{
    /**
     * @link http://fullcalendar.io/docs/event_data/events_json_feed/
     *
     * @param Request $request
     *
     * @return Response
     */
    public function loadAction(Request $request)
    {
        return $this->render('PIdevAllforkidsBundle:Evenement:calender.html.twig');

    }

    public function DataEventAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository('PIdevAllforkidsBundle:Evenement')->findAll();
        $events = array();

        foreach($event as $row){
            $e = array();
            $e['url']="/AllForKids/web/app_dev.php/detailEvenement/".$row->getId_evenement();
            $e['title'] = $row->getNom();
            $e['start'] = $row->getDateDebut()->format('Y-m-d');
            $e['end'] =date( $row->getDateFin()->format('Y-m-d'));

            array_push($events, $e);
        }
        return new JsonResponse($events);
    }

}

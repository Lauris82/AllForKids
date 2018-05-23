<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 21/02/2018
 * Time: 06:20
 */

namespace PIdev\AllforkidsBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use PIdev\AllforkidsBundle\Entity\CalendarEvent as MyCustomEvent;



class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStart();
        $endDate = $calendarEvent->getEnd();
        $filters = $calendarEvent->getFilters();

        //You may want do a custom query to populate the events

        $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
        $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
    }
}
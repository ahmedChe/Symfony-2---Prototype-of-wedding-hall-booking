<?php
/**
 * Created by PhpStorm.
 * User: !L-PAzZ0
 * Date: 19/06/2016
 * Time: 04:12
 */
// src/FrontOffice/ResponsableBundle/Event/CalendarEventListener.php

namespace FrontOffice\ResponsableBundle\Event;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $reservations = $this->entityManager->getRepository('FrontOfficeClientBundle:Reservation')->findBy(array('confirm'=> 2));

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.
        $format = 'Y-m-d';
        foreach($reservations as $reservation) {

            $date = DateTime::createFromFormat($format, $reservation->getDateReservation());

            echo $date->format('Y-m-d 09.00.00') . "\n";
            // create an event with a start/end time, or an all day event
            $eventEntity = new EventEntity($reservation->getClient(), $date, $date);

            //optional calendar event settings
            $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
            $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
            $eventEntity->setUrl('http://www.google.com'); // url to send user to when event label is clicked
            $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }
}
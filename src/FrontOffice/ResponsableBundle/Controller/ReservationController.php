<?php

namespace FrontOffice\ResponsableBundle\Controller;

use FrontOffice\ClientBundle\Entity\Reservation;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{

    public function RetrieveReservationAction()
    {
        $cin=$this->getRequest()->getSession()->get('cin');
        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository('FrontOfficeResponsableBundle:Salle')->findOneBy(array('responsable' => $cin));
        $reservations = $em->getRepository('FrontOfficeClientBundle:Reservation')->findBy(array('salle' => $salle,'confirm'=> 0));
        return $this->render('FrontOfficeResponsableBundle:Reservation:Reservation.html.twig',array('reservations'=>$reservations));
    }
    public function RespondAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id=(int)$_POST['id'];
        $reservation = $em->getRepository('FrontOfficeClientBundle:Reservation')->find($id);
        if ($_POST['action']=='confirmer')
        {
            $reservation->setConfirm(2);
        }
        else
        {
            $reservation->setConfirm(1);
        }
        $em->persist($reservation);
        $em->flush();
        return $this->redirectToRoute('retrieve_reservation');
    }

}

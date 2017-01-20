<?php

namespace BackOffice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository('FrontOfficeClientBundle:Reservation')->findBy(array('confirm'=>array(1,2,3,4)));
        return $this->render('BackOfficeAdminBundle:Dashboard:Reservation.html.twig',array('reservations'=>$reservations));
    }
    public function ClientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients= $em->getRepository('FrontOfficeStaticBundle:Client')->findAll();
        return $this->render('BackOfficeAdminBundle:Dashboard:Clients.html.twig',array('clients'=>$clients));
    }
    public function ResponsablesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $resonsables= $em->getRepository('FrontOfficeStaticBundle:Responsable')->findAll();
        foreach ($resonsables as $respnsable) {
            $salle = $em->getRepository('FrontOfficeResponsableBundle:Salle')->findOneBy(array('responsable' => $respnsable->getCin()));
            $id = $salle->getIdSalle();
            $nombreDeReservation = count($em->getRepository('FrontOfficeClientBundle:Reservation')->findOneBy(array('salle' => $id)));
            $nombreDeReservationReussite = count($em->getRepository('FrontOfficeClientBundle:Reservation')->findOneBy(array('salle' => $id, 'confirm' => array(2, 4))));
               // $note = 100 * ($nombreDeReservationReussite / $nombreDeReservation);
               $note=$nombreDeReservationReussite.'/'.$nombreDeReservation;
                $respnsable->setNote($note);
        }
        return $this->render('BackOfficeAdminBundle:Dashboard:Responsables.html.twig',array('responsables'=>$resonsables));
    }
    public function BlockAction()
    {
        $cin=(int)$_POST['cin'];
        $em = $this->getDoctrine()->getManager();
        $resonsable= $em->getRepository('FrontOfficeStaticBundle:Responsable')->find($cin);
        $resonsable->setBloquage(1);
        $em->persist($resonsable);
        $em->flush();
        return $this->redirect($this->generateUrl('back_office_admin_resoonsables'));
    }
    public function DeblockAction()
    {
        $cin=(int)$_POST['cin'];
        $em = $this->getDoctrine()->getManager();
        $resonsable= $em->getRepository('FrontOfficeStaticBundle:Responsable')->find($cin);
        $resonsable->setBloquage(0);
        $em->persist($resonsable);
        $em->flush();
        return $this->redirect($this->generateUrl('back_office_admin_resoonsables'));
    }
}

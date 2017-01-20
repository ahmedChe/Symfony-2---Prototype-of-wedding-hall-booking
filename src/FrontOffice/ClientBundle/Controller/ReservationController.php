<?php

namespace FrontOffice\ClientBundle\Controller;

use FrontOffice\ClientBundle\Entity\Reservation;
use FrontOffice\ClientBundle\Entity\ServiceDemande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    public function SallesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $salles = $em->getRepository('FrontOfficeResponsableBundle:Salle')->findAll();
        $today=date("Y-m-d");
        foreach ($salles as $salle)
        {
            $id=$salle->getIdSalle();
            $saisons = $em->getRepository('FrontOfficeResponsableBundle:Saison')->findBy(array('idSalle'=>$id));
            foreach ($saisons as $saison)
            {
                $DateBegin = date('Y-m-d', strtotime($saison->getDebut()));
                $DateEnd = date('Y-m-d', strtotime($saison->getFin()));
                if (($today > $DateBegin) && ($today < $DateEnd))
                {
                    $salle->setPrix($saison->getPrix());
                }
            }

        }
        return $this->render('FrontOfficeClientBundle:Reservation:Salles.html.twig',array(
            'salles'=>$salles
        ));
    }
    public function ServiceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository =$em->getRepository('FrontOfficeResponsableBundle:Service');
        $query=$repository->createQueryBuilder('s')
            ->select('s')
            ->where('s.salle = :service')
            ->setParameter('service', $id)
            ->orderBy('s.categorie');
        $services=$query->getQuery()->getResult();
        return $this->render('FrontOfficeClientBundle:Reservation:Services.html.twig', array(
            'services' => $services,
        ));
    }
    public function PropositionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie =$em->getRepository('FrontOfficeResponsableBundle:Service')->find($id)->getCategorie();
        $repository =$em->getRepository('FrontOfficeResponsableBundle:Proposition');
        $query=$repository->createQueryBuilder('p')
            ->select('p')
            ->where('p.service = :service')
            ->setParameter('service', $id);
        $propositions=$query->getQuery()->getResult();
        return $this->render('FrontOfficeClientBundle:Reservation:Propositions.html.twig', array(
            'propositions' => $propositions,
            'id'=>$id,
            'categorie'=>$categorie
        ));
    }
    public function ReservationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $idsalle=$_POST["idSalle"];
        $date=$_POST["date"];
        $prix=(float)$_POST["prixSalle"];
        $session=$this->getRequest()->getSession();
        $cin=$session->get('cin');
        if ($cin == null)
        {
            return $this->redirectToRoute('front_office_Connexion');
        }
        $client=$em->getRepository('FrontOfficeStaticBundle:Client')->find($cin);
        $salle=$em->getRepository('FrontOfficeResponsableBundle:Salle')->find($idsalle);
        $reservation=new Reservation($salle,$client,$date,$prix);
        $em->persist($reservation);
        $em->flush();
        $services = $em->getRepository('FrontOfficeResponsableBundle:Service')->findBy(array('salle'=>$salle));
        $price=$prix;
        foreach ($services as $service)
        {
            $serviceLib=$service->getLibelleService();
            $service=(string)$service->getIdService();
            if (isset($_POST[$service]))
            {
                $proposition=str_replace('+',' ',$_POST[$service]);
                $prix=$services = $em->getRepository('FrontOfficeResponsableBundle:Proposition')->findOneBy(array('libelleProposition'=>$proposition))->getPrixProposition();
                $price=$price+$prix;

                $servicedemande=$serviceLib.' '.$proposition;
                $serviceAajoute=new ServiceDemande($reservation,$servicedemande);
                $em->persist($serviceAajoute);
                $em->flush();
            }

        }
        $reservation->setPrix($price);
        $em->persist($reservation);
        $em->flush();
        return $this->redirectToRoute('Salles_index');

    }
    public function ResponseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservations=$services = $em->getRepository('FrontOfficeClientBundle:Reservation')->findBy(array('client'=>$id,'confirm'=>array(1,2)));
        return $this->render('FrontOfficeClientBundle:Message:Message.html.twig',array(
            'reservations'=>$reservations
        ));
    }
    public function MessageAction()
    {
        $session=$this->getRequest()->getSession();
        $cin=$session->get('cin');
        $em = $this->getDoctrine()->getManager();

        $reservations=$services = $em->getRepository('FrontOfficeClientBundle:Reservation')->findBy(array('client'=>$cin,'confirm'=>array(1,2)));
        $reservation=$reservations[sizeof($reservations)-1];
        return $this->render('FrontOfficeClientBundle:Message:Reservation.html.twig',array(
            'reservation'=>$reservation
        ));
    }
    public function VuAction()
    {
        $id=(int)$_POST['id'];
        $em = $this->getDoctrine()->getManager();
        $reservation=$services = $em->getRepository('FrontOfficeClientBundle:Reservation')->find($id);
        if ($reservation->getConfirm()==1)
        {
            $reservation->setConfirm(3);
        }
        else
        {
            $reservation->setConfirm(4);
        }

        $em->persist($reservation);
        $em->flush();
        return $this->redirectToRoute('front_office_static_homepage');
    }
}


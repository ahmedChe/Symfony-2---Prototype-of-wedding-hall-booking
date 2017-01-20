<?php
/**
 * Created by PhpStorm.
 * User: !L-PAzZ0
 * Date: 10/06/2016
 * Time: 00:01
 */

namespace FrontOffice\ResponsableBundle\Controller;


use FrontOffice\ResponsableBundle\Entity\Saison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SaisonController extends Controller
{
    public function AjoutAction()
    {
       // var_dump($_POST['debut']);die;
        $debut=$_POST['debut'];
        $fin=$_POST['fin'];
        $price=$_POST['prix'];
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $saison=new Saison($salle->getIdSalle(),$debut,$fin,$price);
        $em = $this->getDoctrine()->getManager();
        $metadata = $em->getClassMetaData(get_class($saison));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $em->persist($saison);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');
    }
    public function DeleteAction()
    {
        $indice=$_POST['indice'];
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $em = $this->getDoctrine()->getManager();
        $saisons=$em->getRepository('FrontOfficeResponsableBundle:Saison')->findBy(array('idSalle' => $salle->getIdSalle()));
        $saison=$saisons[$indice-1];
        $em->remove($saison);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');
    }
}
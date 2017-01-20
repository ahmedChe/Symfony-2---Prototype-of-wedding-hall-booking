<?php

namespace FrontOffice\ResponsableBundle\Controller;
use FrontOffice\ResponsableBundle\Entity\Proposition;
use FrontOffice\ResponsableBundle\Entity\Saison;
use FrontOffice\ResponsableBundle\Entity\Service;
use FrontOffice\ResponsableBundle\Form\RemovePropositionsType;
use FrontOffice\ResponsableBundle\Form\SaisonType;
use FrontOffice\ResponsableBundle\Form\SelectionPropositionsType;
use FrontOffice\ResponsableBundle\Form\SelectionServicesType;
use FrontOffice\ResponsableBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MaSalleController extends Controller
{
    public function createServiceForm(Service $entity)
    {
        $form = $this->createForm(new ServiceType(), $entity, array(
            'action' => $this->generateUrl('post_service'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    private function createPrixForm(Saison $entity)
    {
        $form = $this->createForm(new SaisonType(), $entity, array(
            'action' => $this->generateUrl('post_service'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    public function createPropositionsForm(Proposition $pro,$salle,$em)
    {
        $form = $this->createForm(new SelectionPropositionsType($salle,$em), $pro, array(
            'action' => $this->generateUrl('propositions-modifiy'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }
    private function createServicesSelectionForm(Service $service,$salle,$rep)
    {
        $form = $this->createForm(new SelectionServicesType($salle,$rep), $service, array(
            'action' => $this->generateUrl('remove_service'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }
    private function EditServicesSelectionForm(Service $service,$salle,$rep)
    {
        $form = $this->createForm(new SelectionServicesType($salle,$rep), $service, array(
            'action' => $this->generateUrl('edit_service'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }
    public function RemovePropositionsForm(Proposition $pro,$salle,$em)
    {
        $form = $this->createForm(new RemovePropositionsType($salle,$em), $pro, array(
            'action' => $this->generateUrl('remove_prop'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }
    public function MasalleAction()
    {
        $cin=$this->getRequest()->getSession()->get('cin');
        $service = new Service();
        $propostion=new Proposition();
        $form = $this->createServiceForm($service);
        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository('FrontOfficeResponsableBundle:Salle')->findOneBy(array('responsable' => $cin));
        $saisons=$em->getRepository('FrontOfficeResponsableBundle:Saison')->findBy(array('idSalle' => $salle->getIdSalle()));
        //var_dump($saisons);die;
        $this->getRequest()->getSession()->set("salle",serialize($salle));
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Service');
        $form1=$this->createServicesSelectionForm($service,$salle->getIdSalle(),$repo);
        $form2=$this->EditServicesSelectionForm($service,$salle->getIdSalle(),$repo);
        $form3=$this->createPropositionsForm($propostion,$salle->getIdSalle(),$em);
        $form4=$this->RemovePropositionsForm($propostion,$salle->getIdSalle(),$em);
        return $this->render('FrontOfficeResponsableBundle:Salle:MaSalle.html.twig',array(
            'salle' =>$salle,
            'service' => $service,
            'form'=>$form->createView(),
            'form1'=>$form1->createView(),
            'form2'=>$form2->createView(),
            'form3'=>$form2->createView(),
            'form4'=>$form3->createView(),
            'form5'=>$form4->createView(),
            'saisons' =>$saisons,
        ));
    }
    public function AddServiceAction(Request $request)
    {
        $service = new Service();
        $form = $this->createServiceForm($service);
        $form->handleRequest($request);
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $em = $this->getDoctrine()->getManager();
        $service->setSalle($salle);
        $em->clear();
        $em->merge($service);
        $em->flush();
        $request->getSession()->getFlashBag()->add('Ajout', "Votre service est ajouté avec success");
        return $this->redirectToRoute('front_office_masalle');
    }
    public function RemoveServiceAction(Request $request)
    {
        $service = new Service();
        $em = $this->getDoctrine()->getManager();
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Service');
        $form1=$this->createServicesSelectionForm($service,$salle->getIdSalle(),$repo);
        $form1->handleRequest($request);
        $id=(int)$request->request->get('frontoffice_responsablebundle_services')["libelleService"];
        $deleted=$repo->find($id);
        $em->remove($deleted);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');
    }
    public function EditServiceAction(Request $request)
    {
        $service = new Service();
        $form = $this->createServiceForm($service);
        $em = $this->getDoctrine()->getManager();
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Service');
        $form1=$this->EditServicesSelectionForm($service,$salle->getIdSalle(),$repo);
        $form1->handleRequest($request);
        $id=(int)$request->request->get('frontoffice_responsablebundle_services')["libelleService"];
        $nouveau=$request->request->get('frontoffice_responsablebundle_services')["LeService"];
        //var_dump($nouveau);die;
        $modified=$repo->find($id);
        $modified->setLibelleService($nouveau);
        $em->persist($modified);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');
    }
}
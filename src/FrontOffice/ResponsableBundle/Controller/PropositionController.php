<?php
namespace FrontOffice\ResponsableBundle\Controller;
use FrontOffice\ResponsableBundle\Entity\Proposition;
use FrontOffice\ResponsableBundle\Entity\Service;
use FrontOffice\ResponsableBundle\Form\RemovePropositionsType;
use FrontOffice\ResponsableBundle\Form\SelectionPropositionsType;
use FrontOffice\ResponsableBundle\Form\SelectionServicesType;
use FrontOffice\ResponsableBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropositionController extends Controller
{
    public function createPropositionsForm(Proposition $pro,$salle,$em)
    {
        $form = $this->createForm(new SelectionPropositionsType($salle,$em), $pro, array(
            'action' => $this->generateUrl('propositions-modifiy'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }
    public function RemovePropositionsForm(Proposition $pro,$salle,$em)
    {
        $form = $this->createForm(new RemovePropositionsType($salle,$em), $pro, array(
            'action' => $this->generateUrl('propositions-modifiy'),
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
    public function AddAction(Request $request)
    {

        $proposition=new Proposition();
        $service = new Service();
        $em = $this->getDoctrine()->getManager();
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Service');
        $form=$this->EditServicesSelectionForm($service,$salle->getIdSalle(),$repo);
        $form->handleRequest($request);
        $id=(int)$request->request->get('frontoffice_responsablebundle_services')["libelleService"];
        $libelle=$request->request->get('frontoffice_responsablebundle_services')["LeService"];
        $price=$request->request->get('frontoffice_responsablebundle_services')["Price"];
        $service=$repo->find($id);
        $proposition->setService($service);
        $proposition->setLibelleProposition($libelle);
        $proposition->setPrixProposition($price);
        $em->persist($proposition);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');



    }
    public function DisplayAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $props = $em->getRepository('FrontOfficeResponsableBundle:Proposition')->findBy(array('service' => $id));

        $html = '';
        foreach($props as $prop)
       {
           $html = $html . sprintf("<option value=\"%d\">%s</option>",$prop->getIdProposition(), $prop->getLibelleProposition());

       }
        return New Response($html);
    }
    public function ModifyAction(Request $request)
    {
        $proposition=new Proposition();
        $em=$this->getDoctrine()->getManager();
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $form=$this->createPropositionsForm($proposition,$salle->getIdSalle(),$em);
        $form->handleRequest($request);
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Proposition');
        $id=(int)$request->request->get('form_propositions')["libelleProposition"];
        $price=(float)$request->request->get('form_propositions')["prixProposition"];
        $modified=$repo->find($id);
        $modified->setPrixProposition($price);
        $em->persist($modified);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');

    }
    public function RemoveAction(Request $request)
    {
        $proposition=new Proposition();
        $em=$this->getDoctrine()->getManager();
        $salle=unserialize($this->getRequest()->getSession()->get('salle'));
        $form=$this->RemovePropositionsForm($proposition,$salle->getIdSalle(),$em);
        $form->handleRequest($request);
        $repo = $em->getRepository('FrontOfficeResponsableBundle:Proposition');
        $id=(int)$request->request->get('form_propositions_delete')["libelleProposition"];
        $deleted=$repo->find($id);
        $em->remove($deleted);
        $em->flush();
        return $this->redirectToRoute('front_office_masalle');
    }
}

<?php

namespace FrontOffice\StaticBundle\Controller;

namespace FrontOffice\StaticBundle\Controller;

use FrontOffice\ResponsableBundle\Entity\Salle;
use FrontOffice\StaticBundle\Entity\Client;
use FrontOffice\StaticBundle\Entity\Responsable;
use FrontOffice\StaticBundle\Form\ClientType;
use FrontOffice\StaticBundle\Form\ResponsableType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthentificationController extends Controller
{
    private function createResponsableForm(Responsable $entity)
    {
        $form = $this->createForm(new ResponsableType(), $entity, array(
            'action' => $this->generateUrl('front_office_Responsable_Registration'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    private function createClientForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('front_office_Registration'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function createClientAction(Request $request)
    {
        $session=$this->getRequest()->getSession();
        $session->remove('Redirect');
        $test = true;
        $entity1 = new Client();
        $form1 = $this->createClientForm($entity1);
        $form1->handleRequest($request);
        $picture = $_FILES['frontoffice_staticbundle_client']['name']['photo'];
        if ($picture != null) {
            $tab = explode('.', $picture);
            $ext = $tab[count($tab) - 1];
            $extension = array("jpg", "png", "JPG", "PNG");
            if (!in_array($ext, $extension)) {

                $request->getSession()->getFlashBag()->add('photoClient', "Extension d'image invalide");
                $test = false;

            }
        } else {
            $entity1->setPhoto("");
        }

        if ($form1->isValid() && $test) {
            $file = $entity1->getPhoto();

            $fileName = md5(uniqid()) . '.' . $ext;
            $photoDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
            $file->move($photoDir, $fileName);

            $entity1->setPhoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity1);
            $metadata = $em->getClassMetaData(get_class($entity1));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $em->flush();

            return $this->redirect($this->generateUrl('front_office_static_homepage'));
        }
        $request->getSession()
            ->getFlashBag()
            ->add('echecClient', "Verifier votre saisie s'il vous plait");
        return $this->render('FrontOfficeStaticBundle:Authentification:Inscription.html.twig', array(
            'entity1' => $entity1,
            'form1' => $form1->createView(),
        ));
    }

    public function createResponsableAction(Request $request)
    {
        $cin=$_POST['cin'];
        $nomprenom=$_POST['nompr'];
        $tel=$_POST['tel'];
        $email=$_POST['email'];
        $photo=$_FILES['my-image']['name'];
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $nomsalle=$_POST['names'];
        $adrsal=$_POST['adrs'];
        $type=$_POST['type'];
        $surface=$_POST['surface'];
        $capacity=$_POST['capacite'];
        $photosalle=$_FILES['image-s']['name'];
        if ($photo!="")
        {
            $tab = explode('.', $photo);
            $ext = $tab[count($tab) - 1];
            $file = $request->files->get('my-image');
            $fileName = md5(uniqid()) . '.' . $ext;
            $photoDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
            $file->move($photoDir, $fileName);
        }
        else
        {
            $fileName="";
        }
            $responsable=new Responsable($cin,$nomprenom,$tel,$email,$fileName,$user,$pass);

            $tab = explode('.', $photosalle);
            $ext = $tab[count($tab) - 1];
            $file = $request->files->get('image-s');
            $fileName = md5(uniqid()) . '.' . $ext;
            $photoDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
            $file->move($photoDir, $fileName);
            $salle=new Salle($nomsalle,$adrsal,$type,$surface,$capacity,$fileName,$responsable);

            $em = $this->getDoctrine()->getManager();
            $em->persist($responsable);
            $metadata = $em->getClassMetaData(get_class($responsable));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $em->persist($salle);
            $em->flush();
            $session=$this->getRequest()->getSession();
            $session->set("cin",$cin);
            $session->set("role","Responsable");
            return $this->redirect($this->generateUrl('front_office_masalle'));


    }

    public function newAction()
    {

        $entity1 = new Client();
        $form1 = $this->createClientForm($entity1);
        return $this->render('FrontOfficeStaticBundle:Authentification:Inscription.html.twig', array(
            'entity1' => $entity1,
            'form1' => $form1->createView(),
        ));
    }

    public function ConnexionAction()
    {
        return $this->render('FrontOfficeStaticBundle:Authentification:Connexion.html.twig');
    }

    public function GetDataToConnectAction(Request $request)
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $em = $this->getDoctrine()->getManager();
        $repo1 = $em->getRepository('FrontOfficeStaticBundle:Client');
        $repo2 = $em->getRepository('FrontOfficeStaticBundle:Responsable');

        if ($repo1->existClient($username, $pass) != null) {
            $resultat=$repo1->existClient($username, $pass);
            $session=$this->getRequest()->getSession();
                $session->set("cin",$resultat['cin']);
                $session->set("role","Client");
           return $this->redirect($this->generateUrl('front_office_static_homepage'));
        }
        if ($repo2->existResponsable($username, $pass) != null)
        {
            $resultat=$repo2->existResponsable($username, $pass);
            $cin=(int)$resultat['cin'];
            $responsable = $em->getRepository('FrontOfficeStaticBundle:Responsable')->find($cin);
            //var_dump($responsable);die;
            if ($responsable->getBloquage()==1)
            {
                $request->getSession()->getFlashBag()->add('Echec', "Votre compte est bloqué..contactez l'administrateur");
                return $this->render('FrontOfficeStaticBundle:Authentification:Connexion.html.twig');
            }
            $session=$this->getRequest()->getSession();
                $session->set("cin",$resultat['cin'] );
                $session->set("role","Responsable");
            return $this->redirect($this->generateUrl('front_office_static_homepage'));
        }
        $request->getSession()->getFlashBag()->add('Echec', "Verifier vos Cordonnés s'il vous plait..");
        return $this->render('FrontOfficeStaticBundle:Authentification:Connexion.html.twig');
    }


    public function logoutAction()
    {

        $this->get('request')->getSession()->invalidate();
        return $this->redirect($this->generateUrl('front_office_static_homepage'));
    }
    public function profileAction()
    {
        $cin=$this->getRequest()->getSession()->get('cin');
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('FrontOfficeStaticBundle:Client')->find($cin);
        if ($profile==null)
        {
            $profile = $em->getRepository('FrontOfficeStaticBundle:Responsable')->find($cin);
        }

       if ($profile->getPhoto()=="")
       {
           $profile->setPhoto("inconnu.png");
       }
        $this->getRequest()->getSession()->set("profile",serialize($profile));
        return $this->render('FrontOfficeStaticBundle:Authentification:Profile.html.twig',array('profile'=>$profile));
    }
    public function modifierProfileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo1 = $em->getRepository('FrontOfficeStaticBundle:Client');
        $repo2 = $em->getRepository('FrontOfficeStaticBundle:Responsable');
        $session=$this->getRequest()->getSession();
        $cin=$session->get('cin');
        $role=$session->get('role');
        $profile=unserialize($this->getRequest()->getSession()->get('profile'));
        $pass = $_POST['pass'];
        $repass=$_POST['repass'];
        if ($pass!=$repass)
        {
            $request->getSession()->getFlashBag()->add('Echec', "Vous devez tappez deux mots de passe identiques..");
            return $this->render('FrontOfficeStaticBundle:Authentification:Profile.html.twig',array('profile'=>$profile));
        }
        $profile->setTel($_POST['tel']);
        $profile->setEmail($_POST['email']);
        $profile->setLogin($_POST['username']);
        $profile->setPassword($pass);
        $picture=$_FILES['image']['name'];
        if ($picture != "")
        {
            $tab = explode('.', $picture);
            $ext = $tab[count($tab) - 1];
            $extension = array("jpg", "png", "JPG", "PNG");
            if (!in_array($ext, $extension))
            {
                $request->getSession()->getFlashBag()->add('Echec', "Extension d'image invalide");
                $profile=unserialize($this->getRequest()->getSession()->get('profile'));
                return $this->render('FrontOfficeStaticBundle:Authentification:Profile.html.twig',array('profile'=>$profile));
            }
            $file = $request->files->get('image');
            $fileName = md5(uniqid()) . '.' . $ext;
            $photoDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
            $file->move($photoDir, $fileName);

            $profile->setPhoto($fileName);
            if ($role=="Client")
            {
                $repo1->customizedUpdateWithPicture($profile);
            }
            else
            {
                $repo2->customizedUpdateWithPicture($profile);
            }
            $request->getSession()->getFlashBag()->add('Success', "Mise a jour réussite");
            return $this->redirect($this->generateUrl('edit_profile'));
        }
        if ($role=="Client")
        {
            $repo1->customizedUpdateWithoutPicture($profile);
        }
        else
        {
            $repo2->customizedUpdateWithoutPicture($profile);
        }
        $request->getSession()->getFlashBag()->add('Success', "Mise a jour réussite");
        return $this->redirect($this->generateUrl('edit_profile'));
    }

}

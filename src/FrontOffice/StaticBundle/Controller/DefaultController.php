<?php

namespace FrontOffice\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontOfficeStaticBundle:Default:index.html.twig');
    }
    public function AboutAction()
    {
        return $this->render('FrontOfficeStaticBundle:Default:About.html.twig');
    }
    public function EventsAction()
    {
        return $this->render('FrontOfficeStaticBundle:Default:Events.html.twig');
    }
    public function ContactAction()
    {
        return $this->render('FrontOfficeStaticBundle:Mail:Contact.html.twig');
    }
}

<?php

namespace FrontOffice\StaticBundle\Controller;

use FrontOffice\StaticBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailController extends Controller
{
    public function SendAction()
    {
        $form = $this->createForm(new ContactType());
        $request = $this->getRequest();
        if ($request->isMethod('POST'))
        {

            $form->handleRequest($request);

            if ($form->isValid()) {
                var_dump('ok');
                $message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('glid2test@gmail.com')
                    ->setBody(
                            array(
                                'ip' => $request->getClientIp(),
                                'name' => $this->get('request')->request->get('name'),
                                'message' => $this->get('request')->request->get('message')
                            )
                    );
               // var_dump('ok2');die;
                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Votre email a été envoyé avec succes...Merci pour votre interessé =) ');

                //return $this->redirect($this->generateUrl('front_office_Contact'),array('form' => $form->createView()));
            }
        }

        return $this->render('FrontOfficeStaticBundle:Mail:contact.html.twig', array(
            'form' => $form->createView(),
            'ip' => $request->getClientIp(),
            'name'=>$this->get('request')->request->get('name'),
            'message' => $this->get('request')->request->get('message'),
        ));
    }
}

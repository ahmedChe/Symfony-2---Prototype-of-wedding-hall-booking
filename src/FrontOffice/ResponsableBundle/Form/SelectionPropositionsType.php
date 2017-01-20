<?php

namespace FrontOffice\ResponsableBundle\Form;

use FrontOffice\ResponsableBundle\Entity\Salle;
use FrontOffice\ResponsableBundle\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SelectionPropositionsType extends AbstractType
{
    private $salle;
    private $service;
    private $em;
    public function __construct($salle,$em)
    {
        $this->salle = $salle;
        $this->em=$em;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixProposition')
            ->add('libelleProposition', 'choice', array(
                'choices' => null,'empty_value' => '---choisir une Proposition ---'))
            ->add('service', 'entity', array(
            'class' => 'FrontOfficeResponsableBundle:Service',
            'query_builder' => function () {
                return $this->em->getRepository('FrontOfficeResponsableBundle:Service')->createQueryBuilder('s')
                    ->where('s.salle = :salle')
                    ->setParameter('salle', $this->salle);
            },
            'choice_label' => 'libelleService',
            'empty_value' => '---- choisir un Service ----'
        ))
        ->add('Supprimer','submit');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOffice\ResponsableBundle\Entity\Proposition',
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'form_propositions';
    }

}

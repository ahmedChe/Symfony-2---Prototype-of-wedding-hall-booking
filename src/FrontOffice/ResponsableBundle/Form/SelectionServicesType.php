<?php

namespace FrontOffice\ResponsableBundle\Form;

use FrontOffice\ResponsableBundle\Entity\Salle;
use FrontOffice\ResponsableBundle\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectionServicesType extends AbstractType
{
    private $salle;
    private $repo;
    public function __construct($salle,$rep)
    {
        $this->salle = $salle;
        $this->repo=$rep;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleService', 'entity', array(
            'class' => 'FrontOfficeResponsableBundle:Service',
            'query_builder' => function () {
                return $this->repo->createQueryBuilder('s')
                    ->where('s.salle = :salle')
                    ->setParameter('salle', $this->salle);
            },
            'choice_label' => 'libelleService',
        ))
        ->add('LeService', null, array('mapped' => false))
        ->add('Price', null, array('mapped' => false))
        ->add('Supprimer','submit')


        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOffice\ResponsableBundle\Entity\Service'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'frontoffice_responsablebundle_services';
    }

}

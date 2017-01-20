<?php

namespace FrontOffice\ResponsableBundle\Form;

use FrontOffice\ResponsableBundle\Entity\Salle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleService')
            ->add('categorie')
        ->add('Ajouter', 'submit')
            ->add('Annuler','reset')
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
        return 'frontoffice_responsablebundle_service';
    }
    
}

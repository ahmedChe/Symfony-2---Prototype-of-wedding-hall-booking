<?php

namespace FrontOffice\ResponsableBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaisonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut','date')
            ->add('fin')
            ->add('prix')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOffice\ResponsableBundle\Entity\Saison'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'frontoffice_responsablebundle_saison';
    }
    
}

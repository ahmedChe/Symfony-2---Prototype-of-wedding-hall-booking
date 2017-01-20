<?php

namespace FrontOffice\StaticBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('nomprenom')
            ->add('tel')
            ->add('email')
            ->add('photo', 'file', array('required'=>false))
            ->add('login')
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'first_options'  => array('label' => 'Mot de Passe'),
                    'second_options' => array('label' => 'Verification du Mot de passe'),
                )
            )

            ->add('Valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOffice\StaticBundle\Entity\Client'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'frontoffice_staticbundle_client';
    }
    
}

<?php

namespace Rscine\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rscine\AppBundle\Form\ProfileType;

class CustomerProfileType extends ProfileType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('profile'),
            'data_class' => 'Rscine\AppBundle\Entity\User'
        ));
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_customer_profile';
    }
}

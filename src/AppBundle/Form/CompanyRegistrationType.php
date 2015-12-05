<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyRegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siret')
            ->add('name')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('registration'),
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'appbundle_user_registration';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_company_registration';
    }
}

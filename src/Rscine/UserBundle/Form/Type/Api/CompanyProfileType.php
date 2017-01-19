<?php

namespace Rscine\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyProfileType extends AbstractType
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
            'data_class' => 'Rscine\WorkerBundle\Entity\Company'
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'appbundle_user_profile';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_company_profile';
    }
}

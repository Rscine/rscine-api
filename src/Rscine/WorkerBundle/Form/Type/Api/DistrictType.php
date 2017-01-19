<?php

namespace Rscine\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DistrictType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('number')
            ->add('region', 'entity', array(
                'class' => 'RscineWorkerBundle:Region'
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rscine\WorkerBundle\Entity\District'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_district';
    }
}

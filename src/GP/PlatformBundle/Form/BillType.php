<?php

namespace GP\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BillType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('customer', 'entity', array(
                'class'    => 'GPPlatformBundle:Customer',
                'property' => 'lastname',
                'multiple' => false))
			->add('car', 'entity', array(
                'class'    => 'GPPlatformBundle:Car',
                'property' => 'mark',
                'multiple' => false))
            ->add('kms')
            ->add('date', 'date')
            ->add('price') 
			->add('Enregistrer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\PlatformBundle\Entity\Bill'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gp_platformbundle_bill';
    }
}

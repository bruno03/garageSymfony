<?php

namespace GP\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'entity', array(
                'class'    => 'GPPlatformBundle:Title',
                'property' => 'name',
                'multiple' => false))
            ->add('firstname', 'text', array('required' => false))
            ->add('lastname', 'text')
            ->add('address', 'text')
            ->add('cp', 'text')
            ->add('city', 'text')
            ->add('tel1', 'text', array('required' => false))
            ->add('tel2', 'text', array('required' => false))
            //->add('image', new ImageType())
            ->add('Enregistrer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\PlatformBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gp_platformbundle_customer';
    }
}

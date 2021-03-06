<?php
namespace IR\SiteBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrackTimeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('issueId', 'hidden')
            ->add('projectId', 'hidden')
            ->add('hours', 'number', array('label' => 'Годин'))
            ->add('comments', 'textarea', array('label' => 'Коментар', 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IR\SiteBundle\Model\TrackTime'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tracktime';
    }
}

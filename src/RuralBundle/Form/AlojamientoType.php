<?php

namespace RuralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlojamientoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nomAlojamiento')
          ->add('precioAprox')
          ->add('tipoAlquiler')
          ->add('descrip')
          ->add('numEstancia')
          ->add('numPers')
          ->add('servicios')
          ->add('guardar',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RuralBundle\Entity\Alojamiento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ruralbundle_alojamiento';
    }


}

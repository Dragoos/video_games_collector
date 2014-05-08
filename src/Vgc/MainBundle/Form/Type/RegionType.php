<?php

namespace Vgc\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegionType extends AbstractType {

    public function getName() {
        return 'region';
    }

    public function buildForm(FormBuilderInterface $oBuilder, array $options) {
        $oBuilder
                ->add('nom', 'text', [
                    'label' => 'Nom',
                    'max_length' => 255
                ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $oResolver) {
        $oResolver->setDefaults([
            'data_class' => 'Vgc\MainBundle\Entity\Region'
        ]);
    }

}

<?php

namespace Vgc\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SupportRegionType extends AbstractType {

    public function getName() {
        return 'supportRegion';
    }

    public function buildForm(FormBuilderInterface $oBuilder, array $options) {
        $oBuilder
                ->add('support', 'entity', [
                    'class' => 'MainBundle:Support',
                    'property' => 'nom',
                    'label' => 'Support',
                    'empty_value' => 'Veuillez choisir un support ...'
                ])
                ->add('region', 'entity', [
                    'class' => 'MainBundle:Region',
                    'property' => 'nom',
                    'label' => 'Région',
                    'empty_value' => 'Veuillez choisir une région ...'
                ])
                ->add('fullset', 'integer', [
                    'label' => 'Fullset'
                ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $oResolver) {
        $oResolver->setDefaults([
            'data_class' => 'Vgc\MainBundle\Entity\SupportRegion'
        ]);
    }

}

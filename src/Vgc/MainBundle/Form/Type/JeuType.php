<?php

namespace Vgc\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JeuType extends AbstractType {

    public function getName() {
        return 'jeu';
    }

    public function buildForm(FormBuilderInterface $oBuilder, array $options) {
        $oBuilder
                ->add('supportRegion', 'entity', [
                    'class' => 'MainBundle:SupportRegion',
//                    'property' => 'support',
                    'label' => 'Support / Region',
                    'empty_value' => 'Veuillez choisir un support avec la région correspondante...'
                ])
                ->add('nom', 'text', [
                    'label' => 'Nom',
                    'max_length' => 255
                ])
                ->add('prixAchat', 'text', [
                    'label' => 'Prix d\'achat',
                    'max_length' => 255
                ])
                ->add('devise', 'choice', array('choices' =>
                    array('€' => '€',
                        '$' => '$'),
                    'required' => FALSE,
                    'multiple' => FALSE,
                ))
                ->add('codeBarre', 'text', [
                    'label' => 'Code Barre',
                    'max_length' => 255
                ])
                ->add('boite', 'checkbox', [
                    'label' => 'Boîte',
                    'required' => false
                ])
                ->add('notice', 'checkbox', [
                    'label' => 'Notice',
                    'required' => false
                ])
                ->add('jeu', 'checkbox', [
                    'label' => 'Jeu',
                    'required' => false
                ])
                ->add('pointVIP', 'checkbox', [
                    'label' => 'Point VIP',
                    'required' => false
                ])
                ->add('image', 'file')

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $oResolver) {
        $oResolver->setDefaults([
            'data_class' => 'Vgc\MainBundle\Entity\Jeu'
        ]);
    }

}

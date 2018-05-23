<?php

namespace PIdev\AllforkidsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteRTPType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCompteRendu',HiddenType::class)
            ->add('description',TextareaType::class)
            ->add('humeur',ChoiceType::class
                ,array('choices'=>array(
                    'Trés Bonne'=>'Trés Bonne',
                    'Bonne'=>'Bonne',
                    'Maussade'=>'Maussade'
                )))
            ->add('etatS',ChoiceType::class
                ,array('choices'=>array(
                    'Bonne'=>'Bonne',
                    'Pas trés Bonne'=>'Pas trés Bonne',
                    'Mauvaise'=>'Mauvaise'
                ))
            )
            ->add('selles',ChoiceType::class
                ,array(
                    'choices'=>
                        array(
                            'Normales'=>'Normales',
                            'Solides'=>'Solides',
                            'Liquide'=>'Liquide'
                        )
                ))
            ->add('note',ChoiceType::class,
                array(
                    'choices'=>array('Document dans la pochette'=>'Document dans la pochette','vétements souillés'=>'vétements souillés')
                ))
            ->add('activite',ChoiceType::class
                ,array(
                    'choices'=>array('Apprendre a ecrire'=>'Apprendre a ecrire',
                        'Apprendre a colorer'=>'Apprendre a colorer',
                        'jouer avec ballon'=>'jouer avec ballon'
                    )
                ))
            ->add('medicament')
            ->add('separation',ChoiceType::class,array(
                'choices'=>array('Facile'=>'Facile','Difficile'=>'Difficile')
            ))
            ->add('dateDS',TimeType::class)
            ->add('dateFS',TimeType::class)
            ->add('HeureD',TimeType::class)
            ->add('HeureF',TimeType::class)
            ->add('nbrBib',NumberType::class)
            ->add('nbrCouche',NumberType::class)
            ->add('nbrRepas',NumberType::class)
            ->add('etatMangee',ChoiceType::class,
                array('choices'=>
                    array('Beaucoup'=>'Beaucoup','Bien'=>'Bien','peu'=>'peu')
                ))
            ->add('temperature',NumberType::class)
            ->add('respectee',ChoiceType::class,array('choices'=>array('oui'=>'oui','Non'=>'Non')))
            ->add('enfant',HiddenType::class)
            ->add('user',HiddenType::class)
            ->add('Envoyer',SubmitType::class)

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PIdev\AllforkidsBundle\Entity\CompteRTP'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_allforkidsbundle_comptertp';
    }


}

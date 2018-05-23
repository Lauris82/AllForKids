<?php

namespace PIdev\AllforkidsBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteReduType extends AbstractType
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
            ->add('apporter',ChoiceType::class
            ,array(
                'choices'=>array('Couche'=>'Couche','Crème'=>'Crème')
                ))
            ->add('note',ChoiceType::class,
                array(
                    'choices'=>array('Document dans la pochette'=>'Document dans la pochette','vétements souillés'=>'vétements souillés')
                ))
            ->add('activite',ChoiceType::class
            ,array(
                'choices'=>array('Jouer au parc'=>'jouer au parc',
                    'Jouets sonors'=>'Jouets sonors',
                    'jouer à ce cacher'=>'jouer à ce cacher'
                )
                ))
            ->add('separation',ChoiceType::class,array(
                'choices'=>array('Facile'=>'Facile','Difficile'=>'Difficile')
            ))
            ->add('medicament')
            ->add('dateDS',TimeType::class)
            ->add('dateFS',TimeType::class)
            ->add('HeureD',TimeType::class)
            ->add('HeureF',TimeType::class)
            ->add('nbrBib',NumberType::class)
            ->add('nbrCouche',NumberType::class)
            ->add('temperature',NumberType::class)

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
            'data_class' => 'PIdev\AllforkidsBundle\Entity\CompteRedu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_allforkidsbundle_compteredu';
    }


}

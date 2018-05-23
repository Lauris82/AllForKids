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

class CompteRSCType extends AbstractType
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
            ->add('activite',ChoiceType::class
                ,array(
                    'choices'=>array('Jouer avec PC'=>'jouer avec PC',
                        'Faire les devoirs'=>'Faire les devoirs',
                        'Regarder la télé'=>'Regarder la télé'
                    )
                ))
            ->add('HeureD',TimeType::class)
            ->add('HeureF',TimeType::class)
            ->add('nbrRepas',NumberType::class)
            ->add('etatMangee',ChoiceType::class,
                array('choices'=>
                    array('Beaucoup'=>'Beaucoup','Bien'=>'Bien','peu'=>'peu')
                ))

            ->add('respectee',ChoiceType::class,array('choices'=>array('oui'=>'oui','Non'=>'Non')))
            ->add('travailDevoir',ChoiceType::class,array('choices'=>array('oui'=>'oui','Non'=>'Non')))
            ->add('RemarqueEcole',TextareaType::class)
            ->add('enfant',HiddenType::class)
            ->add('user',HiddenType::class)
            ->add('Envoyer',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PIdev\AllforkidsBundle\Entity\CompteRSC'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_allforkidsbundle_comptersc';
    }


}

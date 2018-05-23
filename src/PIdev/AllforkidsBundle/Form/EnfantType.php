<?php

namespace PIdev\AllforkidsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class EnfantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')

            ->add('dateNaissance',DateType::class)
           ->add('sexe',ChoiceType::class,
            array(
               'choices'=>
                   array(
                'Femme'=>'Femme',
                'Homme'=>'Homme'
            )))

//            ->add('sexe')
            /*    ->add('genre',RadioType::class
            ,array('choices'=>array('m'=>'homme','f'=>'femme'),
                    'expanded'=>true,
                    'multiple'=>false
                    )
            )*/
            ->add('categorie',ChoiceType::class
                ,array(
                    'choices'=>
                        array(
                            'Nourrisson'=>'Nourrisson',
                            'Tout Petit'=>'Tout Petit',
                            'Préscolaire'=>'Préscolaire',
                            'Scolaire'=>'Scolaire'
                        )
                ))
            ->add('file')

            ->add('Ajouter',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PIdev\AllforkidsBundle\Entity\Enfant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_allforkidsbundle_enfant';
    }


}

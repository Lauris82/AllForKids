<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 22/02/2018
 * Time: 21:08
 */

namespace PIdev\AllforkidsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RechercheEvenementAjaxForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder->add('nom');
    }
    public function configureOptions(OptionsResolver $resolver)
    {

    }
    public function getBlockPrefix()
    {
      return 'PIdev_allForKids_bundle_recherche_evenement'  ;
    }

}


<?php

namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('sexe', ChoiceType::class, array(
            'choices' => array(
                'M' => true,
                'Mme' => false,
            ),
            'choices_as_values' => true,
        ))
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('datebirth', BirthdayType::class)
        ->add('email', EmailType::class)
        ->add('pays', CountryType::class)
        ->add('zipcode', TextType::class)
        //->add('autreResidence', CheckboxType::class)
        ->add('autreResidence', ChoiceType::class, array(
            'choices' => array(
                'No' => false,
                'Yes' => true,
            ),
            'choices_as_values' => true,
        ))
        ->add('autrePays', CountryType::class)
        ->add('idNumberFiscale', NumberType::class)
        ->add('offre', CheckboxType::class)
        ->add('save', SubmitType::class, array('label' => 'Submit'))
        ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_formulaire';
    }
}

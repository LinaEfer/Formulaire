<?php

namespace AppBundle\Form;

use AppBundle\Entity\Formulaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isProcessorDisable = $options['isProcessorDisable'];

        $builder
        ->add('gender', ChoiceType::class, [
            'choices' => Formulaire::getGenderValues(),
            'multiple' => false,
            'expanded' => true,
            'label' => 'Civilité ',
            'label_attr' => ['class' => 'radio-inline'],
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Prénom ',
            'attr' => ['maxlength' => 250,
                       'placeholder' => 'Prénom', ],
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom ',
            'attr' => ['maxlength' => 250,
                       'placeholder' => 'Nom', ],
        ])
        ->add('datebirth', BirthdayType::class, [
            'label' => 'Date de naissance',
        ])
        ->add('email', EmailType::class, [
            'label' => 'E-mail',
            'attr' => ['placeholder' => 'example@domain.com'],
        ])
        ->add('country', CountryType::class)
        ->add('zipcode', TextType::class, [
            'attr' => ['maxlength' => 5,
                       'placeholder' => 'XXXXX', ],
        ])
        ->add('otherResidence', ChoiceType::class, [
            'choices' => Formulaire::getOtherResidenceValues(),
        ])
        ->add('otherCountry', CountryType::class, [
            'required' => false,
            'placeholder' => 'Choose an option',
        ])
        ->add('numberFiscale', NumberType::class, [
            'attr' => ['maxlength' => 11,
                       'placeholder' => 'XXXXXXXXXXX', ],
        ])
        ->add('offer', CheckboxType::class, [
            'label' => 'Accepter de recevoir nos offres.',
            'required' => false,
            'disabled' => $isProcessorDisable,
            'attr' => ['data-toggle' => 'toggle',
                       'data-on' => 'Oui',
                       'data-off' => 'No', ],
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Valider',
        ])
        ->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'empty_data' => new Formulaire(),
            'data_class' => Formulaire::class,
            'isProcessorDisable' => false,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_formulaire';
    }
}

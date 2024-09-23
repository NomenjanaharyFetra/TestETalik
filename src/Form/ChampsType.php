<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChampsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Texte' => 'text',
                    'Nombre' => 'number',
                    'Date' => 'date',
                    'Radio' => 'radio',
                    'SelectBox'=>'selectbox',

                ],
                'label' => 'Type de Champ',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom du Champ',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom du champ'],
            ])
            ->add('options', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'label' => false,
                'attr' => ['class' => 'options-collection'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}

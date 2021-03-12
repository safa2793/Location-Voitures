<?php


namespace VoitureBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoitureForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', TextareaType::class)
            ->add('marque', TextareaType::class)
            ->add('couleur', TextareaType::class)
            ->add('modele', TextareaType::class)
            ->add('kilometrage', TextareaType::class)
            ->add('prix', TextareaType::class)
            ->add('disponibilite', ChoiceType::class, [
                'choices' => [
                    'dispo' => true,
                    'indispo' => false
                ]
            ]);
    }

    public function getName() {
        return 'Voiture';
    }
}
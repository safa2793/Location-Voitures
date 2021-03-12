<?php


namespace VoitureBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class GestionnaireForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('GestionnaireCIN', TextareaType::class)
            ->add('nom', TextareaType::class)
            ->add('prenom', TextareaType::class)
            ->add('MDP', PasswordType::class)
            ->add('mail', TextareaType::class)
            ->add('adresse', TextareaType::class);
    }

    public function getName() {
        return 'Gestionnaire';
    }
}
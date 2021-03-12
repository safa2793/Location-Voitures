<?php


namespace VoitureBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ReservationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ReservationId', TextareaType::class)
            ->add('Date_reservation', DateType::class)
            ->add('Date_retour', DateType::class)
            -> add('Client',EntityType::class, array(
                'class' => 'VoitureBundle\Entity\Client',
                'choice_label'=>'ClientId',
                'expanded'=>false,
                'multiple'=>false))
            -> add('Voiture',EntityType::class, array(
                'class' => 'VoitureBundle\Entity\Voiture',
                'choice_label'=>'matricule',
                'expanded'=>false,
                'multiple'=>false));
    }

    public function getName() {
        return 'Reservation';
    }
}
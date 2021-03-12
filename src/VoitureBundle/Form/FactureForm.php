<?php


namespace VoitureBundle\Form;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FactureForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IdFacture', TextareaType::class)
            ->add('MontantFacture', TextareaType::class)
            ->add('DateFacture', DateType::class)
            -> add('resa',EntityType::class, array(
                'class' => 'VoitureBundle\Entity\Reservation',
                'choice_label'=>'ReservationId',
                'expanded'=>false,
                'multiple'=>false));

    }

    public function getName() {
        return 'fact';
    }
}
<?php

namespace App\Form;

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Soutenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('encadrer', EntityType::class, ['class' => Enseignant::class, 'choice_label' => 'mail', 'attr' => ['class' =>'form-control']])
            ->add('raporteur', EntityType::class, ['class' => Enseignant::class, 'choice_label' => 'mail', 'attr' => ['class' =>'form-control']])
            ->add('president', EntityType::class, ['class' => Enseignant::class, 'choice_label' => 'mail', 'attr' => ['class' =>'form-control']])
            ->add('etudiant', EntityType::class, ['class' => Etudiant::class, 'choice_label' => 'mail','attr' => ['class' =>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Soutenance::class,
        ]);
    }
}
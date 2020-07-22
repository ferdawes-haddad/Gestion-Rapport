<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Rapport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, ['attr' => ['class' =>'form-control']])
            ->add('file', FileType::class, array('required' => false, 'attr' => ['class' =>'form-control']))
            ->add('description', TextareaType::class, ['attr' => ['class' =>'form-control']])
            ->add('enseignants', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => 'mail',
                'attr' => ['class' =>'form-control']])
//            ->add('etudiants')
            ->add('classe', ChoiceType::class, ['choices'  => [ '3 éme' => true, '4 éme' => true, '5 éme' => true ], 'attr' => ['class' =>'form-control']])
            ->add('section', ChoiceType::class, ['choices'  => [ 'Licence' => true, 'Cycle ingéniere' => true, 'Management' => true], 'attr' => ['class' =>'form-control']])
            ->add('annee', NumberType::class, ['attr' => ['class' =>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Rapport::class,]);
    }
}

<?php

namespace App\Form;

use App\Entity\Rapport;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', FileType::class, array('label'=>'Choissesez votre rapport'))
            ->add('description')
       //     ->add('enseignants')
//            ->add('etudiants')
            ->add('classes', ChoiceType::class, ['choices'  => [ '3 éme' => null, '4 éme' => null, '5 éme' => null ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}

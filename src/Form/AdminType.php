<?php

namespace App\Form;

use App\Entity\Admin;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('document', FileType::class, array('data_class' => null,'label'=>'Choissesez un fichier','required' => false, 'attr' => ['class' =>'form-control']))
            ->add('personne', ChoiceType::class, ['choices'  => [ ''=> null, 'étudiant' => false, 'enseignant' => false]])
            ->add('dateDepos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}

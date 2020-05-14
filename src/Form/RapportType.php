<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Rapport;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', FileType::class, array('data_class' => null,'required' => false))
            ->add('description')
            ->add('enseignants', ChoiceType::class)
//            ->add('etudiants')
            ->add('classe', ChoiceType::class, ['choices'  => [ '3 éme' => true, '4 éme' => true, '5 éme' => true ]])
            ->add('section', ChoiceType::class, ['choices'  => [ 'Licence' => true, 'Cycle ingéniere' => true, 'Management' => true ]])
            ->add('annee')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}

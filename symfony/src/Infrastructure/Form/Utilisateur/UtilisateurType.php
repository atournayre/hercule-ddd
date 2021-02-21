<?php

namespace App\Infrastructure\Form\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('prenom')
            ->add('nom')
            ->add('abreviation')
            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer'])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UtilisateurFormVO::class,
        ]);
    }
}

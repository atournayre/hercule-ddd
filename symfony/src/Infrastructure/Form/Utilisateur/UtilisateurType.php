<?php

namespace App\Infrastructure\Form\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez renseigner un email',
                        ]),
                        new Email([
                            'message' => 'Veuillez renseigner un email valide.',
                        ])
                    ],
                ]
            )
            ->add('prenom')
            ->add('nom')
            ->add(
                'abreviation',
                TextType::class,
                [
                    'constraints' => [
                        new Length([
                            'min' => 3,
                            'max' => 3,
                            'exactMessage' => 'Veuillez renseigner une abréviation contenant {{ limit }} caractères.',
                        ]),
                        new Regex([
                            'pattern' => '/^[A-Z]{3}$/',
                            'htmlPattern' => '^[a-zA-Z]{3}$',
                            'message' => 'Cette abréviation n\'est pas valide.',
                        ])
                    ]
                ]
            )
            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UtilisateurFormVO::class,
        ]);
    }
}

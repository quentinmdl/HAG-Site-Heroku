<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Session;
use App\Repository\SessionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupType extends AbstractType
{
    private $SessionRepository;

    public function __construct(SessionRepository $SessionRepository)
    {
        $this->SessionRepository = $SessionRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'   => false,
                'attr' => array(
                    'placeholder' => 'Saississez le nom du groupe'
                )
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choices' => $this->SessionRepository->SelectLastSession(),
                'label' => false,
                'attr' => array('style'=>'display:none;')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class,
        ]);
    }
}

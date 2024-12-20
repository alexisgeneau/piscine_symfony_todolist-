<?php

namespace App\Form;

use App\Entity\Priority;
use App\Entity\Status;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Titre de la tâche'
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Description'
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un statut',
                'attr' => ['class' => 'form-select'],
                'label' => 'Statut',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez une priorité',
                'attr' => ['class' => 'form-select'],
                'label' => 'Priorité',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('ajouter', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}

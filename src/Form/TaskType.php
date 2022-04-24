<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Task',
                
            ])
            ->add('status',ChoiceType::class,[
                'label' => 'Priority:',
                'choices' => [
                   
                    'urgent' => 'urgent',
                    'second-priority' => 'Second-priority',
                    'relax' => 'relax',
                ],
            ])
            ->add('createdAt',DateType::class, [
                'widget' => 'single_text',
                
            ])

            ->add('process',ChoiceType::class,[
                'label' => 'Progress:',
                'choices' => [
                    'TODO' => 'TODO',
                    'Doing' => 'Doing',
                    'Done' => 'Done',
                ],
            ])
            ->add('deadline',DateType::class,[
                'label' => 'Deadline of your task:',
                'widget' => 'single_text',
               
            ])
            ->add('category', EntityType::class, [
                    // looks for choices from this entity
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'label' => 'Your task depends on:',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
    
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

<?php

namespace App\Form;

use App\Entity\ExperienciaLaboral;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienciaLaboralType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('empresa', TextType::class, [
                'label' => 'Empresa',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ingrese el nombre de la empresa',
                ],
            ])
            ->add('cargo', TextType::class, [
                'label' => 'Cargo',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ingrese el cargo desempeñado',
                ],
            ])
            ->add('estadoLaboral', ChoiceType::class, [
                'label' => 'Estado Laboral',
                'choices' => [
                    'Empleado' => 'Empleado',
                    'Desempleado' => 'Desempleado',
                    'Emprendedor' => 'Emprendedor',
                    'Freelance' => 'Freelance',
                ],
            ])
            ->add('sector', TextType::class, [
                'label' => 'Sector',
                'required' => false,
            ])
            ->add('relacionadoCarrera', ChoiceType::class, [
                'label' => '¿El trabajo está relacionado con su carrera?',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'required' => false,
            ])
            ->add('fechaInicio', DateType::class, [
                'label' => 'Fecha de Inicio',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('fechaFin', DateType::class, [
                'label' => 'Fecha de Fin',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
            ])
            ->add('nombreJefeDirecto', TextType::class, [
                'label' => 'Nombre del Jefe Directo',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ingrese el nombre del jefe directo',
                ],
            ])
            ->add('emailContactoTthh', TextType::class, [
                'label' => 'Email de Contacto de TTHH',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ingrese el email de contacto de TTHH',
                ],
            ])
            ->add('permitirContactoTthh', ChoiceType::class, [
                'label' => '¿Permitir contacto de TTHH?',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => ExperienciaLaboral::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Graduado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraduadoInteresesType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('busca_empleo', CheckboxType::class, [
                'required' => false,
                'label' => 'Estoy buscando empleo',
            ])
            ->add('habilidades_clave', TextType::class, [
                'required' => false,
                'label' => 'Habilidades clave (separadas por coma)',
                'help' => 'Ej: PHP, Symfony, Docker',
            ])
            ->add('temas_interes_formacion', TextType::class, [
                'required' => false,
                'label' => 'Temas de interés para formación',
            ])
            ->add('tipo_colaboracion', TextType::class, [
                'required' => false,
                'label' => 'Tipo de colaboración',
                'help' => 'Charlas, mentorías, bolsa de empleo, etc.',
            ])
            ->add('logros_destacados', TextareaType::class, [
                'required' => false,
                'label' => 'Logros destacados',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Graduado::class,
        ]);
    }
}

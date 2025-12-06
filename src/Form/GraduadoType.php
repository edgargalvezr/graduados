<?php

namespace App\Form;

use App\Entity\Carrera;
use App\Entity\Graduado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraduadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cedula')
            ->add('apellidos')
            ->add('nombres')
            ->add('cohorte')
            ->add('numeroRegistro')
            ->add('email')
            ->add('telefono')
            ->add('paisResidencia')
            ->add('ciudadResidencia')
            ->add('buscaEmpleo')
            ->add('cvPath')
            ->add('interesadoColaborar')
            ->add('logrosDestacados')
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('temasInteresFormacion')
            ->add('modalidadPreferida')
            ->add('habilidadesClave')
            ->add('aspiracionSalarial')
            ->add('tipoColaboracion')
            ->add('nombreJefeDirecto')
            ->add('emailContactoRrhh')
            ->add('telefonoContactoRrhh')
            ->add('permisoContactoEmpleador')
            ->add('carrera', EntityType::class, [
                'class' => Carrera::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Graduado::class,
        ]);
    }
}

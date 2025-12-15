<?php

namespace App\Controller\Graduado;

use App\Entity\EstudioPosterior;
use App\Entity\ExperienciaLaboral;
use App\Form\EstudioPosteriorCollectionType;
use App\Form\ExperienciaLaboralCollectionType;
use App\Form\GraduadoContactoType;
use App\Form\GraduadoInteresesType;
use App\Repository\GraduadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graduado/wizard')]
final class GraduadoWizardController extends AbstractController {
    private const STEPS = ['contacto', 'experiencia', 'estudios', 'perfil'];

    #[Route('/{step}', name: 'app_graduado_wizard', requirements: ['step' => 'contacto|experiencia|estudios|perfil'], methods: ['GET',
        'POST'])]
    public function step(Request $request, EntityManagerInterface $em, GraduadoRepository $graduadoRepository,
        string $step = 'contacto'): Response {
        $graduado = $graduadoRepository->find($this->getUser());

        // Selecciona el FormType correspondiente al paso actual
        $form = match ($step) {
            'contacto' => $this->createForm(GraduadoContactoType::class, $graduado),
            'experiencia' => (function() use ($graduado) {
                if ($graduado->getExperienciaLaboral()->count() === 0) {
                    $graduado->addExperienciaLaboral(new ExperienciaLaboral());
                }
                return $this->createForm(ExperienciaLaboralCollectionType::class, $graduado);
            })(),
            'estudios' => (function() use ($graduado) {
                if ($graduado->getEstudiosPosteriores()->count() === 0) {
                    $graduado->addEstudiosPosteriore(new EstudioPosterior());
                }
                return $this->createForm(EstudioPosteriorCollectionType::class, $graduado);
            })(),
            'perfil' => $this->createForm(GraduadoInteresesType::class, $graduado),
        };

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistir cambios en la base de datos
            $em->flush();

            // Navegación según botón
            if ($request->request->get('save_exit')) {
                $this->addFlash('success', 'Se guardaron los cambios correctamente.');
                return $this->redirectToRoute('app_graduado_perfil_index');
            }

            $nextStep = $this->nextStep($step);
            if ($nextStep) {
                return $this->redirectToRoute('app_graduado_wizard', ['step' => $nextStep]);
            }

            $this->addFlash('success', '¡Listo! Tu perfil está actualizado.');
            return $this->redirectToRoute('app_graduado_perfil_index');
        }

        $progressIndex = array_search($step, self::STEPS, true);
        $percent = (int) round(($progressIndex + 1) / count(self::STEPS) * 100);
        $prev = method_exists($this, 'prevStep') ? $this->prevStep($step) : null;

        return $this->render('graduado_wizard/step.html.twig', [
            'form' => $form,
            'step' => $step,
            'percent' => $percent,
            'steps' => self::STEPS,
            'prev' => $prev ?? self::STEPS[0],
        ]);
    }

    private function nextStep(string $current): ?string {
        $idx = array_search($current, self::STEPS, true);
        return $idx !== false && isset(self::STEPS[$idx + 1]) ? self::STEPS[$idx + 1] : null;
    }

    private function prevStep(string $current): ?string {
        $idx = array_search($current, self::STEPS, true);
        return $idx !== false && $idx > 0 ? self::STEPS[$idx - 1] : null;
    }
}

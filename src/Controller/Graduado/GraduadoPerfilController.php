<?php

namespace App\Controller\Graduado;

use App\Entity\Graduado;
use App\Form\GraduadoType;
use App\Repository\GraduadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graduado/perfil')]
final class GraduadoPerfilController extends AbstractController {
    #[Route(name: 'app_graduado_perfil_index', methods: ['GET'])]
    public function index(GraduadoRepository $graduadoRepository): Response {
        $user = $graduadoRepository->findBy(['cedula' => $this->getUser()->getUserIdentifier()]);
        return $this->render('graduado_perfil/index.html.twig', [
            'graduados' => $user,
        ]);
    }

    /* #[Route('/new', name: 'app_graduado_perfil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $graduado = new Graduado();
        $form = $this->createForm(GraduadoType::class, $graduado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($graduado);
            $entityManager->flush();

            return $this->redirectToRoute('app_graduado_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('graduado_perfil/new.html.twig', [
            'graduado' => $graduado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_graduado_perfil_show', methods: ['GET'])]
    public function show(Graduado $graduado): Response
    {
        return $this->render('graduado_perfil/show.html.twig', [
            'graduado' => $graduado,
        ]);
    }*/

    #[Route('/{id}/edit', name: 'app_graduado_perfil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Graduado $graduado, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(GraduadoType::class, $graduado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_graduado_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('graduado_perfil/edit.html.twig', [
            'graduado' => $graduado,
            'form' => $form,
        ]);
    }

    /*#[Route('/{id}', name: 'app_graduado_perfil_delete', methods: ['POST'])]
    public function delete(Request $request, Graduado $graduado, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$graduado->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($graduado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_graduado_perfil_index', [], Response::HTTP_SEE_OTHER);
    }*/
}

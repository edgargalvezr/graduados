<?php

namespace App\Controller\Graduado;

use App\Repository\GraduadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class
GraduadoLoginController extends AbstractController {
    #[Route('/acceso', name: 'app_graduado_acceso', methods: ['GET', 'POST'])]
    public function login(Request $request, GraduadoRepository $graduadoRepository): Response {
        // Si ya está autenticado como graduado, redirige
        if ($this->isGranted('ROLE_GRADUADO')) {
            return $this->redirectToRoute('app_graduado_perfil_index');
        }

        // El POST será interceptado por el autenticador; aquí renderizas el formulario
        return $this->render('security/graduado_login/index.html.twig');
    }

    #[Route('/graduado/logout', name: 'app_graduado_logout')]
    public function logout(Request $request): Response {
        // Interceptado por el firewall `graduado`
        throw new \LogicException('Interceptado por el firewall.');
    }
}

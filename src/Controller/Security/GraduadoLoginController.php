<?php

namespace App\Controller\Security;

use App\Repository\GraduadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class
GraduadoLoginController extends AbstractController {
    #[Route('/acceso', name: 'app_acceso', methods: ['GET', 'POST'])]
    public function login(Request $request, GraduadoRepository $graduadoRepository): Response {
        // Si ya está logueado, redirigir al perfil (pendiente de implementar)
        if ($request->getSession()->get('graduado_id')) {
            // return $this->redirectToRoute('app_graduado_perfil');
            // Por ahora redirigimos a la misma página con un mensaje
            $this->addFlash('info', 'Ya has iniciado sesión.');
        }

        if ($request->isMethod('POST')) {
            $cedula = $request->request->get('cedula');
            $apellidos = $request->request->get('apellidos');

            if (!$cedula || !$apellidos) {
                $this->addFlash('error', 'Por favor ingrese cédula y apellidos.');
            } else {
                $graduado = $graduadoRepository->findOneBy([
                    'cedula' => $cedula,
                    'apellidos' => $apellidos, // La búsqueda debe ser exacta según requerimiento
                ]);

                if ($graduado) {
                    // Login exitoso
                    $request->getSession()->set('graduado_id', $graduado->getId());
                    $request->getSession()->set('graduado_nombre', $graduado->getNombres() . ' ' . $graduado->getApellidos());

                    $this->addFlash('success', 'Bienvenido/a ' . $graduado->getNombres());
                    // return $this->redirectToRoute('app_graduado_perfil'); // TODO: Crear ruta
                    return $this->render('security/graduado_login/index.html.twig', [
                        'success_login' => true,
                        'graduado' => $graduado,
                    ]);
                } else {
                    $this->addFlash('error',
                        'Credenciales incorrectas. Verifique que sus apellidos estén escritos exactamente como en su registro.');
                }
            }
        }

        return $this->render('security/graduado_login/index.html.twig');
    }

    #[Route('/logout', name: 'app_graduado_logout')]
    public function logout(Request $request): Response {
        $request->getSession()->remove('graduado_id');
        $request->getSession()->remove('graduado_nombre');
        $this->addFlash('success', 'Has cerrado sesión correctamente.');
        return $this->redirectToRoute('app_acceso');
    }
}

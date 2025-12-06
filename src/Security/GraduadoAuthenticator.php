<?php

namespace App\Security;

use App\Entity\Graduado;
use App\Repository\GraduadoRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class GraduadoAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface {
    public function __construct(
        private readonly GraduadoRepository $graduadoRepository,
        private readonly RouterInterface $router) {
    }

    public function supports(Request $request): ?bool {
        return $request->attributes->get('_route') === 'app_graduado_acceso' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport {
        $cedula = trim((string) $request->request->get('cedula', ''));
        $apellidos = trim((string) $request->request->get('apellidos', ''));

        // El UserBadge identificará al usuario por cédula
        $userBadge = new UserBadge($cedula, function(string $cedula) {
            return $this->graduadoRepository->findOneBy(['cedula' => $cedula]);
        });

        // Valida apellidos exactos
        $credentials = new CustomCredentials(function($providedApellidos, $user) {
            if (!$user instanceof Graduado) {
                return false;
            }

            $normalize = function(string $s): string {
                $s = preg_replace('/\s+/', ' ', trim($s));
                $s = mb_strtoupper($s, 'UTF-8');
                $s = \Normalizer::normalize($s, \Normalizer::FORM_D);
                return preg_replace('/\p{Mn}+/u', '', $s); // quita marcas diacríticas
            };
            return $normalize($user->getApellidos() ?? '') === $normalize($providedApellidos ?? '');
        }, $apellidos);

        // Si en el formulario agregas un token CSRF, descomenta:
        $badges[] = new CsrfTokenBadge('authenticate', (string) $request->request->get('_csrf_token'));

        return new Passport($userBadge, $credentials, $badges);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response {
        // Redirigir al perfil o a una página de éxito
        $targetUrl = $this->router->generate('app_graduado_perfil_index', []); // crea esta ruta cuando estés listo
        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response {
        // Reenvía al login con un mensaje
        $request->getSession()->getFlashBag()->add('error', 'Credenciales incorrectas. Verifique sus datos.');
        return new RedirectResponse($this->router->generate('app_graduado_acceso'));
    }

    // Para cuando se intenta acceder a una página protegida sin estar autenticado
    public function start(Request $request, AuthenticationException $authException = null): Response {
        return new RedirectResponse($this->router->generate('app_graduado_acceso'));
    }
}

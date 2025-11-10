<?php

namespace App\Controller\Admin;

use App\Entity\Carrera;
use App\Entity\EstudioPosterior;
use App\Entity\ExperienciaLaboral;
use App\Entity\Graduado;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController {
    public function index(): Response {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard {
        return Dashboard::new()
            ->setTitle('ISTFO - Graduados');
    }

    public function configureMenuItems(): iterable {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Entities');
        yield MenuItem::linkToCrud('Carreras', 'fas fa-list', Carrera::class);
        yield MenuItem::linkToCrud('Graduados', 'fas fa-list', Graduado::class);
        yield MenuItem::linkToCrud('Experiencia Laboral', 'fas fa-list', ExperienciaLaboral::class);
        yield MenuItem::linkToCrud('Estudio Posterior', 'fas fa-list', EstudioPosterior::class);
        //yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out-alt');
    }
}

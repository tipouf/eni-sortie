<?php

namespace App\Controller\Admin;

use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Contributor;
use App\Entity\Location;
use App\Entity\Trip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Eni');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Participants', 'fas fa-list', Contributor::class);
        yield MenuItem::linkToCrud('Lieux', 'fas fa-list', Location::class);
        yield MenuItem::linkToCrud('Campus', 'fas fa-list', Campus::class);
        yield MenuItem::linkToCrud('Villes', 'fas fa-list', City::class);
    }
}

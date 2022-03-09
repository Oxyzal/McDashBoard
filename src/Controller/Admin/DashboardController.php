<?php

namespace App\Controller\Admin;

use App\Entity\District;
use App\Entity\Product;
use App\Entity\ProductRestaurant;
use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RestaurantCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('McDo i love it');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section();
        yield MenuItem::subMenu('Core');
        yield MenuItem::linkToCrud('Districts', 'fa fa-building', District::class);
        yield MenuItem::linkToCrud('Restaurant', 'fas fa-utensils', Restaurant::class);
        yield MenuItem::subMenu('Kaka');
        yield MenuItem::linkToCrud('Products', 'fas fa-burger-soda', Product::class);
        yield MenuItem::subMenu('Core');
        yield MenuItem::linkToCrud('Products-Restaurant', 'fas fa-burger-soda', ProductRestaurant::class);
    }
}

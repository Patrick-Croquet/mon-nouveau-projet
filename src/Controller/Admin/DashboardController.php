<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Entity\Produit;
use App\Entity\Fournisseur;

use App\Repository\AuteurRepository;
use App\Repository\ProduitRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    protected $AuteurRepository;
    protected $ProduitRepository;
    public function __construct(
        AuteurRepository $AuteurRepository,
        ProduitRepository $ProduitRepository,
    )
    {
       $this->AuteurRepository = $AuteurRepository;
       $this->ProduitRepository = $ProduitRepository; 
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /*return parent::index();*/

        $countAuthors = $this->AuteurRepository->countAllAuteurs();
        $countProducts = $this->ProduitRepository->countAllProduits();
        return $this->render('admin/dashboard.html.twig', [
            'Auteurs' => $countAuthors,
            'Produits' => $countProducts
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mon Nouveau Projet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-tags', User::class);
        yield MenuItem::section('Mes BD');
            yield MenuItem::linkToCrud('Produits', 'fas fa-tags', Produit::class);
            yield MenuItem::linkToCrud('Auteurs', 'fas fa-tags', Auteur::class);
            yield MenuItem::linkToCrud('Genres', 'fas fa-tags', Genre::class);
            yield MenuItem::linkToCrud('Editeurs', 'fas fa-tags', Editeur::class);
            yield MenuItem::linkToCrud('Fournisseurs', 'fas fa-tags', Fournisseur::class);

    }
}

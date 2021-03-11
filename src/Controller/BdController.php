<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BdController extends AbstractController
{
    /**
     * @Route("/bd", name="bd")
     */
    public function index(AuteurRepository $repo, PaginatorInterface $paginator, request $request): Response
    {
        $allAuthors = $repo->findAll();
        //$allAuthors = $repo->findAuteursWithProduits();

        //Paginate the results of the query
        $auteurs = $paginator->paginate(
            // Doctrine Query, not results
            $allAuthors,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10  
        );
        return $this->render('bd/index.html.twig', [
            'controller_name' => 'BdController',
            'auteurs' => $auteurs
        ]);
    }

    /**
     * @Route("/", name="home")
     */    
    public function home(): Response
    {
        return $this->render('bd/home.html.twig', [
            'title' => 'Bienvenue sur le site des BD !',
            'age' => 53
        ]);
    }

    /**
     * @Route("/livres/auteur/{id}", name="bd_show")
     */
    public function show($id, ProduitRepository $repo) {

        $produits = $repo->findby(array("auteur" => $id));
        //$couvertures = ['BD000001','BD000007','BD000013'];
        $couvertures = array();

        $dir = "images/";
        if ( $dossier = opendir($dir)){
            while ( ($item = readdir($dossier)) !== false) {
                  //if ($item[0] == '.') { continue; }
                  $pos_point = strpos($item, '.');
                  $item = substr($item, 0,  $pos_point);
                  $couvertures[] = strtoupper($item);
            }
            closedir($dossier);
        }



        return $this->render('bd/show.html.twig', [
            'produits' => $produits,
            'couvertures' => $couvertures  
        ]);
    }
}

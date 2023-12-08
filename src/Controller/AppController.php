<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
    
    #[Route('/listec', name: 'app_produit_liste_categ')]
    public function liste(CategorieRepository $repos): Response
    {
        $categories = $repos->findAll();
       // dd($produits);
        
        
        return $this->render('app/listecateg.html.twig', [
            'categs' => $categories,
        ]);
    }
    #[Route('/categorie/ajout/{name}', name: 'app_categorie_ajout')]
    public function ajout($name,EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $categorie->setName($name);
      
      
        
        $em->persist($categorie);
        $em->flush();
        
        return $this->redirectToRoute('app_produit_liste_categ');
        
    }

    #[Route('/categorie/delete/{id}', name: 'app_categorie_delete')]
    public function delete($id,CategorieRepository $repos,EntityManagerInterface $em): Response
    {
        $categorie = $repos->find($id);
       if(!$categorie)
       {

       }
       $em->remove($categorie);
       $em->flush(); 
        
        return $this->redirectToRoute('app_produit_liste_categ');
    }
    
}

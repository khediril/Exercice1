<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/liste', name: 'app_produit_liste')]
    public function liste(ProduitRepository $repos): Response
    {
        $produits = $repos->findAll();
       // dd($produits);
        
        
        return $this->render('produit/liste.html.twig', [
            'prods' => $produits,
        ]);
    }
    #[Route('/produit/ajout/{name}/{price}', name: 'app_produit_ajout')]
    public function ajout($name,$price,EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $produit->setName($name);
        $produit->setPrice($price);
        $produit->setDescription("bla bla bla bla bla");
        
        $em->persist($produit);
        $em->flush();
        
        return $this->render('produit/liste.html.twig', [
            'prods' => $produits,
        ]);
    }
}

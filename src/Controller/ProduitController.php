<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends AbstractController
{
   
    #[Route('/liste/{min}/{max}', name: 'app_produit_liste_min_max')]
    public function listeMinMax($min,$max,ProduitRepository $repos): Response
    {
        $produits = $repos->findAllMinMax2($min,$max);
       // dd($produits);
        
        
        return $this->render('produit/listeMinMax.html.twig', [
            'prods' => $produits,'nb' => count($produits)
        ]);
    }
    
    #[Route('/categ/list/{idc}', name: 'app_produit_par_categorie')]
    public function liste_par_categ($idc,CategorieRepository $repos): Response
    {
        $produits = $repos->find($idc)->getProduits();
       // dd($produits);
        
        
        return $this->render('produit/liste.html.twig', [
            'prods' => $produits,
        ]);
    }
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
        
        return $this->redirectToRoute('app_produit_liste');
        
    }
    #[Route('/produit2/add', name: 'app_produit_add2')]
    public function add(EntityManagerInterface $em,Request $request): Response
    {
        $produit = new Produit();
      
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            //$produit = $form->getData();
            $em->persist($produit);
            $em->flush();
            $this->addFlash('info',
            'Produit ajoute avec succes...'
        );
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_produit_liste');
        }
      /*  */
        
       return $this->render('produit/add.html.twig',['form'=>$form]);
        
    }
    

    #[Route('/produit/delete/{id}', name: 'app_produit_delete')]
    public function delete($id,ProduitRepository $repos,EntityManagerInterface $em): Response
    {
        $produit = $repos->find($id);
       if(!$produit)
       {

       }
       $em->remove($produit);
       $em->flush(); 
       $this->addFlash('warning',
       'Produit supprime avec succes...'
   );
        return $this->redirectToRoute('app_produit_liste');
    }



    #[Route('/produit/{id}', name: 'app_produit_details')]
    public function detail($id,ProduitRepository $repos): Response
    {
        $produit = $repos->find($id);
       if(!$produit)
       {

       }
        
        
       return $this->render('produit/details.html.twig', [
        'prod' => $produit,
    ]);
    }

    #[Route('/produit/update/{id}/{nouvprix}', name: 'app_produit_update')]
    public function update($id,$nouvprix, ProduitRepository $repos,EntityManagerInterface $em): Response
    {
        $produit = $repos->find($id);
        $produit->setPrice($nouvprix);

       if(!$produit)
       {

       }
       $em->persist($produit);
       $em->flush(); 
        
        return $this->redirectToRoute('app_produit_liste');
    }


}

<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(): Response
    {
        return $this->render('recherche/recherche.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
    #[Route('/resultat', name: 'resultat')]
    public function resultat(Request $request): Response
    {
        $mot = $request->query->get('mot');
        //dd($mot);
        $r  = $this->render('recherche/resultat.html.twig', [
            'controller_name' => 'AppController',
        ]);
        return $r;
    }
}

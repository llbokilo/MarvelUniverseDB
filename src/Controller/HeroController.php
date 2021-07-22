<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController{
    /**
     * @Route("/hero", name="hero")
     */
    public function index(): Response{
        return $this->render('hero/index.html.twig', ['controller_name' => 'HeroController',]);
    }
    /**
     * @Route("/hero/list", name="liste_hero")
     */
    public function list(HeroService $heroService): Response{
        $listeHeros =$heroService->getList();
        return $this->render('hero/list.html.twig',['heroList'=>$listeHeros]);
    }

    public function newHero():Response{
        return $this->render('heros\creer.html.twig',[]);
    }
}

<?php

namespace App\Controller;

use App\Services\HeroService;
use App\Entity\Hero;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $listeHeros = $heroService->getList();
        return $this->render('hero/list.html.twig',['heroList'=>$listeHeros]);
    }
    /**
     * @Route("hero/create","hero_creation")
     */
    public function newHero(Request $request,HeroService $heroService):Response
    {

        $hero = new Hero('','',false,'','','');
        $form = $this->createFormBuilder($hero)
        ->add('Nom',TextType::class)
        ->add('Prenom',TextType::class)
        ->add('Pseudo',TextType::class)
        ->add('Description',TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Créer Hero'])
            ->getForm();
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hero = $form->getData();
            $heroService->addHero($hero);
            return $this->render('hero/create_completed.html.twig',['hero'=>$hero]);
        }
        else
            return $this->render('hero/creer.html.twig',['formulaire'=>$form->createView()]);
    }
    /**
    * @Route("hero/{pId}","hero_show")
    */
    public function show($pId, HeroService $heroService):Response
    {
        $hero = $heroService->getHero($pId);
        return $this->render('hero/hero.html.twig',['hero'=>$hero['hero']]);
    }
    /**
     * @Route("hero/delete/{pId}","hero_delete")
     */
    public function delete($pId, HeroService $heroService):Response
    {
        $heroService->delHero($pId);
        return $this->render('hero/delete_completed.html.twig');
    }

}

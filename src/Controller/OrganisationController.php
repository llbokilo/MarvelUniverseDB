<?php

namespace App\Controller;

use App\Services\OrganisationService;
use App\Entity\Organisation;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrganisationController extends AbstractController
{
    /**
     * @Route("/organisation", name="organisation")
     */
    public function index(): Response{
        return $this->render('organisation/index.html.twig', ['controller_name' => 'OrganisationController',]);
    }

    public function newOrga():Response{
        return $this->render('organisation/creer.html.twig',[]);
    }

    /**
     * @Route("/organisation/list", name="liste_organisation")
     */
    public function list(OrganisationService $OrgaService): Response{
        $listeOrgas = $OrgaService->getListOrga();
        return $this->render('organisation/list.html.twig',['OrgaList'=>$listeOrgas]);
    }

    /**
     * @Route("organisation/create","organisation_creation")
     */
    public function newOrganisation(Request $request, OrganisationService $OrgaService):Response{

        $Orga = new Organisation('','');
        $form = $this->createFormBuilder($Orga)
        ->add('Name',TextType::class)
        ->add('City',TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Créer Organisation'])
            ->getForm();
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hero = $form->getData();
            $OrgaService->addOrga($Orga);
            return $this->render('organisation/create_completed.html.twig',['orga'=>$Orga]);
        }
        else
            return $this->render('organisation/creer.html.twig',['formulaire'=>$form->createView()]);
    }

    /**
    * @Route("organisation/{pId}","organisation_show")
    */
    public function show($pId, OrganisationService $orgaService):Response
    {
        $orga = $orgaService->getOrga($pId);
        return $this->render('organisation/orga.html.twig',['orga'=>$orga['organisation']]);
    }

    /**
     * @Route("organisation/delete/{pId}","organisation_delete")
     */
    public function delete($pId, OrganisationService $orgaService):Response{
        $orgaService->delOrga($pId);
        return $this->render('organisation/delete_completed.html.twig');
    }
}

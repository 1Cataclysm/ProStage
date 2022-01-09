<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
use App\Repository\StageRepository;



class AfficheUnePageController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAccueil(StageRepository $repositoryStage): Response
    {
        #$repositoryStage = $this->getDoctorine()->getRepository(Stage::class);
        $listeStages = $repositoryStage->findAll();
        return $this->render('affiche_une_page/index.html.twig', [
            'listeStages' => $listeStages
        ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function indexEntreprises(EntrepriseRepository $repositoryEntreprise): Response
    {   
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('affiche_une_page/indexEntreprise.html.twig', [
            'entreprises' => $entreprises
        ]);
    }
    
    /**
     * @Route("/entreprise/{id}", name="entrepriseStage")
     */
    public function indexEntrepriseStage(EntrepriseRepository $repositoryEntreprise, StageRepository $repositoryStage, $id): Response
    {   
        $entreprise = $repositoryEntreprise->find($id);
        $listeStages = $repositoryStage->findBy(["entreprise"=>$id]);

        return $this->render('affiche_une_page/indexEntrepriseStage.html.twig', [
            'entreprise' => $entreprise, 'listeStages' => $listeStages
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function indexFormation(FormationRepository $repositoryFormation): Response
    {
        $listeFormations = $repositoryFormation->findAll();
        
        return $this->render('affiche_une_page/indexFormation.html.twig', [
            'listeFormations' => $listeFormations
        ]);
    }

    /**
     * @Route("/formations/{id}", name="formationStage")
     */
    public function indexFormationStage(FormationRepository $repositoryFormation, $id): Response
    {
        $formation = $repositoryFormation->find($id);
        
        return $this->render('affiche_une_page/indexFormationStage.html.twig', [
            'formation' => $formation
        ]);
    }


    /**
     * @Route("/stage/{id}", name="detailStage")
     */
    public function indexDetailStage(StageRepository $repositoryStage, $id): Response
    {
        $stage = $repositoryStage->find($id);
        
        return $this->render('affiche_une_page/indexDetailStage.html.twig', [
            'stage' => $stage
        ]);
    }   


}


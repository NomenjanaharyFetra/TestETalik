<?php

namespace App\Controller;

use App\Entity\Champsresult;
use App\Entity\Formulaire;
use App\Form\FormulaireType;
use App\Repository\ChampsresultRepository;
use App\Repository\FormulaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\VarDumper\Cloner\Data;

class FormulaireController extends AbstractController
{
    // fonction pour afficher listes des champs et un formulaire
    #[Route('/formulaire/{id}', name: 'voir_formulaire')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function voir(int $id, EntityManagerInterface $entityManager): Response
    {
        $formulaire = $entityManager->getRepository(Formulaire::class)->find($id);
        if (!$formulaire) {
            throw $this->createNotFoundException('Formulaire non trouvé');
        }

        $reponses = $entityManager->getRepository(Champsresult::class)->findBy(['FormulaireChamps' => $formulaire]);

        return $this->render('formulaire/index.html.twig', [
            'formulaire' => $formulaire,
            'reponses' => $reponses
        ]);
    }
    // Fonction pour faire enregister les champs d'un formulaire
    #[Route('/formulaire/soumettre/{id}', name: 'soumettre_formulaire')]
    public function soumettre(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $entityManager->getRepository(Formulaire::class)->find($id);
        if (!$form) {
            throw $this->createNotFoundException('Formulaire non trouvé');
        }

        if ($request->isMethod('POST')) {
            $resultat = new Champsresult();
            $resultat->setFormulaireChamps($form);
            
            $data = $request->request->all();
            $resultat->setData($data);

            $entityManager->persist($resultat);
            $entityManager->flush();

            return $this->redirectToRoute('voir_formulaire', ['id' => $form->getId()]);
        }

        return $this->render('formulaire/index.html.twig', [
            'formulaire' => $form,
        ]);
    }
    // Fonction pour afficher  listes d'un formulaire et les champs associées d'un utilisateur connecté
    #[Route('/list', name: 'listes_champs')]
    public function List(ChampsresultRepository $champsresultRepository,Security $security ,FormulaireRepository $formulaireRepository): Response
    {
        $user = $security->getUser();

        $formulaires = $formulaireRepository->findFormulaireByUser($user);
    
        $resultatsParFormulaire = [];
    
        foreach ($formulaires as $formulaire) {
            $resultats = $champsresultRepository->findBy(['FormulaireChamps' => $formulaire]);
    
            $resultatsParFormulaire[$formulaire->getId()] = [
                'formulaire' => $formulaire,
                'resultats' => $resultats,
            ];
        }
            return $this->render('formulaire/lists.html.twig', [
            'resultatsParFormulaire' => $resultatsParFormulaire,
        ]);
    }


}

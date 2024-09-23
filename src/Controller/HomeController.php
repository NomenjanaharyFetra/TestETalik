<?php

namespace App\Controller;

use App\Entity\Formulaire;
use App\Form\FormulaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    // Fonction pour afficher la page d'accueil et pour créer un formulaire
    #[Route('/', name: 'app_home')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function creer(Request $request, EntityManagerInterface $entityManager,Security $security): Response
    {
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $security->getUser();
            $formulaire->setFormulaireUser($user);
            $entityManager->persist($formulaire);
            $entityManager->flush();

            return $this->redirectToRoute('voir_formulaire', ['id' => $formulaire->getId()]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    //Fonction pour afficher page non trouvée
    #[Route('/error/404', name: 'error_404')]
    public function notFound(): Response
    {
        return $this->render('error/error404.html.twig');
    }
}

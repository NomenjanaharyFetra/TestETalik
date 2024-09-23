<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorController extends AbstractController
{
    // Fonction pour afficher la page non trouvée
    #[Route('/error/404', name: 'error_404')]
    public function notFound(): Response
    {
        return $this->render('Error/erreur404.html.twig');
    }
}

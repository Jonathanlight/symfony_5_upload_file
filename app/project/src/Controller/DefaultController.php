<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Manager\MovieManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @param MovieManager $movieManager
     * @return Response
     */
    public function index(Request $request, MovieManager $movieManager): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movieManager->create($movie);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/index.html.twig', [
            'movies' => $movieManager->list(),
            'form' => $form->createView(),
        ]);
    }
}

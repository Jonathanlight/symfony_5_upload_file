<?php

namespace App\Manager;

use App\Entity\Movie;
use App\Services\MessageService;
use Doctrine\ORM\EntityManagerInterface;

class MovieManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var MessageService
     */
    protected $messageService;

    public function __construct(EntityManagerInterface $entityManager, MessageService $messageService)
    {
        $this->em = $entityManager;
        $this->messageService = $messageService;
    }

    public function list()
    {
        return $this->em->getRepository(Movie::class)->findAll();
    }

    public function create(Movie $movie)
    {
        $this->em->persist($movie);
        $this->em->flush();

        return $this->messageService->addSuccess('Movie save.');
    }
}
<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;


class HomepageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Event::class);
        $events = $repository->findAll();

        return $this->render('event/homepage.html.twig', [
            "events" => $events
        ]);
    }
}
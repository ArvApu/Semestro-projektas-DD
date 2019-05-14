<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $events = $repository->findAll();

        return $this->render('event/homepage.html.twig', [
            "events" => $events
        ]);
    }
}
<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Repository\DateTime;
use App\Form\EventFilterType;
use Symfony\Component\HttpFoundation\Request;


class HomepageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Request $request)
    {
        $form = $this->createForm(EventFilterType::class);
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Event::class);
        
        if($form->isSubmitted() && $form->isValid()){
            $params = $request->request->all()['event_filter'];
            $events = $repository->getEventsByCriteria($params['title'], $params['category'], $params['description'], /*$params['date_from']*/null, /*$params['date_to']*/null, $params['price'], $params['location']);
        } else {
            $events = $repository->findAll();
        }

        return $this->render('event/homepage.html.twig', [
            "events" => $events,
            'form' => $form->createView(),

        ]);
    }
}
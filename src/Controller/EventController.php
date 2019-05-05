<?php
/**
 * Created by PhpStorm.
 * User: arvapu
 * Date: 19.3.28
 * Time: 13.48
 */

namespace App\Controller;


use App\Form\EventFormType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

class EventController extends AbstractController
{

    /**
     * @Route("/admin/event/new", name="create_event")
     */
    public function addEvent(Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $event = new Event();

        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return new RedirectResponse($urlGenerator->generate('app_homepage'));
        }

        return $this->render('event/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/event/{id}/delete", name="event_delete")  
     */
    public function eventRemoveAction($id)
    {
        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        // Redirect to the table page
        return $this->redirect($this->generateUrl('app_homepage'));
        
    }

    /**
     * @Route("/event/{id}/edit", name="event_edit")  
     */
    public function eventEditAction(Request $request, $id)
    {
        $event = new Event();
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);

        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirect($this->generateUrl('app_homepage'));
        }

        return $this->render('event/edit.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("event/{eventId}", name="event_show")
     */
    public function show($eventId)
    {
        $repository = $this->getDoctrine()->getRepository(Event::class);
        $event = $repository->findOneBy(['id' => $eventId]);

        if (!$event)
        {
            throw $this->createNotFoundException(sprintf('No event with id "%s"', $eventId));
        }

        return $this->render('event/show.html.twig', [
            'event' =>  $event
        ]);
    }}
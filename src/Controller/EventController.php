<?php
/**
 * Created by PhpStorm.
 * User: arvapu
 * Date: 19.3.28
 * Time: 13.48
 */

namespace App\Controller;


use App\Form\CommentFormType;
use App\Form\EventFormType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Entity\Comment;

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
     * @Route("event/{eventId}", name="event_show")
     */
    public function show(Request $request, $eventId)
    {

        $repository = $this->getDoctrine()->getRepository(Event::class);
        $event = $repository->findOneBy(['id' => $eventId]);

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findBy(['event' => $event->getId()]);

        if (!$event) {
            throw $this->createNotFoundException(sprintf('No event with id "%s"', $eventId));
        }

        $comment = new Comment();

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setAuthor($this->getUser());
            $comment->setEvent($event);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'comments' => $comments
        ]);
    }
}
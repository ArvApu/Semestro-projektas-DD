<?php

namespace App\Controller;


use App\Form\CommentFormType;
use App\Form\EventFormType;
use App\Repository\CommentRepository;
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
    public function addEvent(Request $request, UrlGeneratorInterface $urlGenerator, \Swift_Mailer $mailer)
    {
        $event = new Event();

        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            $to = array();

            $categories = $event->getCategory()->getSubscribedUsers();

            foreach ($categories as $member) {
                $to[] = $member->getEmail();

                $message = (new \Swift_Message('Pridėtas naujas renginys'))
                ->setFrom('semestroprojektasdd@gmail.com')
                ->setTo($to)
                ->setBody(
                $this->renderView(
                    'emails/newevent.html.twig',
                    array(
                        'category' => $event->getCategory()->getName(),
                        'event' => $event->getTitle(),
                        'description' => $event->getDescription()
                    )
                ),
                'text/html'
            )
                ;
                $mailer->send($message);
            }

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
     * @Route("event/{id}", name="event_show")
     */

    public function show(Request $request, Event $event, CommentRepository $repository)
    {
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
            'comments' => $repository->findBy(['event' => $event->getId()],['id' => 'DESC']),
        ]);
    }
}
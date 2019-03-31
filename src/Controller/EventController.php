<?php
/**
 * Created by PhpStorm.
 * User: arvapu
 * Date: 19.3.28
 * Time: 13.48
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('event/homepage.html.twig');
    }

    /**
     * @Route("/event/{eventId}", name="event_show")
     */
    public function show($eventId)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('event/show.html.twig', [
            'title' =>  ucwords(str_replace('-',' ', $eventId)),
            'comments' => $comments

        ]);
    }}
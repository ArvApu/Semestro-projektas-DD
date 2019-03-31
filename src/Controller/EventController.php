<?php
/**
 * Created by PhpStorm.
 * User: arvapu
 * Date: 19.3.28
 * Time: 13.48
 */

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Event;

class EventController extends AbstractController
{

    /**
     * @Route("/event/new", name="create_event")
     */
    public function newEvent(EntityManagerInterface $em)
    {
        $user = new User();
        $event = new Event('Bek uz tevyne','Labai geras begimas',"sveikata","2019-08-02",null,"Kaunas KTU",$user);

        $em->persist($event);
        $em->flush();

        return new Response('<html><body>Yay event created</body></html>');
    }

    /**
     * @Route("/event/{eventId}", name="event_show")
     */
    public function show($eventId)
    {
        return $this->render('event/show.html.twig', [
            'title' =>  ucwords(str_replace('-',' ', $eventId)),

        ]);
    }}
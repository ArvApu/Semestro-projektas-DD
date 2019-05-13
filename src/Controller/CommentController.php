<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{commentId}/delete", name="comment_delete")
     */
    public function delete($commentId)
    {
        dump($commentId);
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($commentId);

        dump($comment);
        $eventId = $comment->getEvent()->getId();
        dump($eventId);

        $em = $this->getDoctrine()->getManager();
        $em-> remove($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('event_show',['eventId' => $eventId]));
    }
}

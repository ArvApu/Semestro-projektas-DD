<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{commentId}/delete", name="comment_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete($commentId)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($commentId);

        $eventId = $comment->getEvent()->getId();

        $em = $this->getDoctrine()->getManager();
        $em-> remove($comment);
        $em->flush();
        return $this->redirect($this->generateUrl('event_show',['id' => $eventId]));
    }
}

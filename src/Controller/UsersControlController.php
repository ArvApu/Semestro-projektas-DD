<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersControlController extends AbstractController
{
    /**
     * @Route("/users/control", name="users_control")
     * @IsGranted("ROLE_ADMIN")
     */
    public function displayUsers()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findWithoutRole("ROLE_ADMIN");

        return $this->render('users_control/index.html.twig', [
            'users' => $users,
        ]);
    }


    /**
     * @Route("/users/{userId}/delete", name="user_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete($userId)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($userId);


        $em = $this->getDoctrine()->getManager();
        $em-> remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('users_control'));
    }

}

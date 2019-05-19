<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserUpdateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, LoggerInterface $logger, UrlGeneratorInterface $urlGenerator)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());

        $user = $this->getUser();

        $form = $this->createForm(UserUpdateFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return new RedirectResponse($urlGenerator->generate('app_account'));
        }


        return $this->render('account/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


}

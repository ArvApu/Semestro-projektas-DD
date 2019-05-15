<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ChangePasswordController extends Controller
{
    /**
     * @Route("/changePassword", name="app_changePassword")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('base');
        }
        $newPassword = new User();
        $user = $this->getUser();
        $error = "";
        $form = $this->createForm(ChangePasswordType::class, $newPassword);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            if($encoder->isPasswordValid($user, $newPassword->getPassword()))
            {
                //The old password which user used is correct.
                //So we can change the password in user object
                $user->setPassword($encoder->encodePassword($user, $newPassword->getNewPassword()));
                $em->persist($user);
                $em->flush();
                return $this->render('account/changePassword.html.twig', array(
                    'success' => "Slaptažodis pakeistas.",
                    'form'=>$form->createView(),
                ));
            }else{
                $error = "Dabartinis slaptažodis neteisingas.";
            }
        }
        return $this->render('account/changePassword.html.twig', array(
            'error' => $error,
            'form'=>$form->createView(),
        ));
    }
    public function show()
    {
        return $this->render('account/changePassword.html.twig', [
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\ForgotPassword;
use App\Entity\User;
use App\Form\SetNewPasswordType;
use App\Form\ForgotPasswordType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\HttpFoundation\Request;

class RecoverController extends AbstractController
{

    /**
     * @Route("/recover", name="app_recover")
     */
    public function remindPassword(Request $request, \Swift_Mailer $mailer): Response
    {
        $error="";
        $user = new ForgotPassword();
        $form = $this->createForm(ForgotPasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($user)
            {
                $passwordResetToken = base64_encode(random_bytes(20));
                $passwordResetToken = str_replace("/","",$passwordResetToken); // because / will make errors with routes
                $user->setPasswordResetToken($passwordResetToken);
                $this->getDoctrine()->getManager()->flush();
                $message = (new \Swift_Message('Pakeisti slaptažodį'))
                    ->setFrom('semestroprojektasdd@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'emails/remindpass.html.twig',
                            array(
                                'token' => $passwordResetToken,
                                'username' => $user->getUsername()
                            )
                        ),
                        'text/html'
                    )
                ;
                $mailer->send($message);
                return $this->render('recover/recover.html.twig', [
                'form'=>$form->createView(),
                'action' => "reset",
                'success' => "Laiškas su nuoroda atkurti slaptažodį išsiųstas."
                ]);
            }
            else {
                $error="Naudotojo su tokių elektroninių paštu nėra.";
            }
        }
        
        return $this->render('recover/recover.html.twig', [
            'form'=>$form->createView(),
            'action' => "reset",
            'error' => $error
        ]);
    }

    /**
     * @Route("/recover/{token}", name="app_reset")
     */
    public function setNewPassword(Request $request, $token, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['passwordResetToken' => $token]);
        if($user == null)
        {
            return $this->redirectToRoute('base');
        }
        $newPassword = new User();
        $form = $this->createForm(SetNewPasswordType::class, $newPassword);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $password = $encoder->encodePassword($user, $newPassword->getPassword());
            $user->setPassword($password);
            //"NULL" because it has to be a string; when doing a password reset, we must then
            // check if token is not "NULL"
            $user->setPasswordResetToken(NULL);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('recover/recover.html.twig', [
            'form'=>$form->createView(),
            'action' => "set"
        ]);
    }
}

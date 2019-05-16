<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     * @IsGranted("ROLE_USER")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());
       
        $username = $this->getUser()->getUsername();

        return $this->render('account/index.html.twig', [
            "username" => $username,
            "subcategories" => $this->getUser()->getSubscribedCategories()
        ]);
    }
}

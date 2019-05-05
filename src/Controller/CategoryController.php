<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\SubscribedCategory;
use App\Form\SubscribedCategoryType;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/new", name="app_category_create")
     */
    public function create(Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $category = new Category();

        $form =$this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return new RedirectResponse($urlGenerator->generate('app_category_create'));
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("categories", name="category_show")
     */
    public function show()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        $repository2 = $this->getDoctrine()->getRepository(User::class);
        $users = $repository2->findAll();


        return $this->render('category/show.html.twig', [
            "categories" => $categories]);
    }


    /**
     * @Route("/category/{id}/delete", name="category_delete")  
     */
    public function categoryRemoveAction($id)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        // Redirect to the table page
        return $this->redirect($this->generateUrl('category_show'));
        
    }

    /**
     * @Route("/category/{id}/edit", name="category_edit")  
     */
    public function categoryEditAction(Request $request, $id)
    {
        $category = new Category();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirect($this->generateUrl('category_show'));
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }


     /**
     * @Route("categories/{id}/subscribe", name="category_subscribe")
     */
    public function subscribe($id, UserInterface $user)
    {
   //     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $category = new Category();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $subscribedCategory = new SubscribedCategory();

        $userId = $user->getId(); 

  //      $subscribedCategory->setCategories([$categoryName]);

        $subscribedCategory->setMatching($userId);

        $subscribedCategory->setCategories([$id]);


     //   $subscribedCategory->setCategories(['xdd', 'xdds']);

        $entityManager->persist($subscribedCategory);

        $entityManager->flush();

        return new Response('Saved new subscription with users id '.$subscribedCategory->getMatching());

      //  return $this->render('category/subscribe.html.twig', ["categories" => $categories]);
    }

    /**
     * @Route("categories/{id}/unsubscribe", name="category_unsubscribe")
     */
    public function unsubscribe($id, UserInterface $user)
    {
        $category = new Category();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
    }
    
}

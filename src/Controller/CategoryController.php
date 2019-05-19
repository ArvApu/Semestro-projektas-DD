<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Event;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validation;

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
            
            return new RedirectResponse($urlGenerator->generate('category_show'));
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("categories", name="category_show")
     */
    public function show(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->render('category/show.html.twig', [
            "categories" => $categories
        ]);
    }

    /**
     * @Route("/category/{id}/delete", name="category_delete")  
     */
    public function categoryRemoveAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
            
        if(!$category->getEvents()->isEmpty())
        {
            $this->get('session')->getFlashBag()->add(
                'error',
                'This category is used in other events!');
        }
        else
        {
            $em->remove($category);
            $em->flush();
        }

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
    public function subscribe($id, UserInterface $user,UrlGeneratorInterface $urlGenerator)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        $user->addSubscribedCategory($category);
        $category->addSubscribedUser($user);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        return new RedirectResponse($urlGenerator->generate('app_homepage'));
    }

    /**
     * @Route("categories/{id}/unsubscribe", name="category_unsubscribe")
     */
    public function unsubscribe(Category $category, UserInterface $user, UrlGeneratorInterface $urlGenerator)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        $user->removeSubscribedCategory($category);
        $category->removeSubscribedUser($user);

        $this->getDoctrine()->getManager()->flush();

        return new RedirectResponse($urlGenerator->generate('app_homepage'));
    }    
}

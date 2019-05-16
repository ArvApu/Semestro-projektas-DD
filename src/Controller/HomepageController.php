<?php


namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Request $request, EventRepository $repository, PaginatorInterface $paginator)
    {
        $queryBuilder = $repository->getWithSearchQueryBuilder();

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );


        return $this->render('event/homepage.html.twig', [
            "events" => $pagination
        ]);
    }
}
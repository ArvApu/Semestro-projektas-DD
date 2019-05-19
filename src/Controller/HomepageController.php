<?php


namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Repository\DateTime;
use App\Form\EventFilterType;

class HomepageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Request $request, EventRepository $repository, PaginatorInterface $paginator)
    {
        $form = $this->createForm(EventFilterType::class);
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Event::class);
        
        if($form->isSubmitted() && $form->isValid()){
            $params = $request->request->all()['event_filter'];
            $queryBuilder = $repository->getEventsByCriteria($params['title'], $params['category'], $params['description'], /*$params['date_from']*/null, /*$params['date_to']*/null, $params['price'], $params['location']);
        } else {
            $queryBuilder = $repository->getWithSearchQueryBuilder();
        }

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('event/homepage.html.twig', [
            "events" => $pagination,
            'form' => $form->createView(),
        ]);
    }
}
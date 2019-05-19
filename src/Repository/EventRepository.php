<?php

namespace App\Repository;

use App\Repository\DateTime;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function getEventsByCriteria(?string $title, ?string $category, ?string $description, ?DateTime $date_from, ?DateTime $date_to, ?string $price, ?string $location): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e')->leftJoin('e.category', 'c');

        if($title){
            $qb->andWhere($qb->expr()->like('e.title', ':title'))
                ->setParameter('title', '%'. $title. '%');
        }
        if($category){
            $qb->andWhere($qb->expr()->like('c.id', ':category'))
                ->setParameter('category', $category);
        }
        if($description){
            $qb->andWhere($qb->expr()->like('e.description', ':description'))
                ->setParameter('description', '%'. $description. '%');
        }
        if($date_from && $date_to){
            $qb->andWhere($qb->expr()->between('e.date', ':date_from', ':date_to'))
                ->setParameter('date_from', $date_from, \Doctrine\DBAL\Types\Type::DATETIME)
                ->setParameter('date_to', $date_to, \Doctrine\DBAL\Types\Type::DATETIME);
        }
        if($price || $price == 0){
            $price = strpos($price, '.') ?  $price : $price . ".00";
            $qb->andWhere($qb->expr()->like('e.price', ':price'))
                ->setParameter('price', $price);
        }
        if($location){
            $qb->andWhere($qb->expr()->like('e.location', ':location'))
                ->setParameter('location', '%'. $location. '%');
        }
        return $qb;
    }

    public function getWithSearchQueryBuilder(): QueryBuilder
    {
        $qb = $this->_em->createQueryBuilder();

        return  $qb->select('u')->from($this->_entityName, 'u');
    }

}

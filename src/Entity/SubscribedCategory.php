<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscribedCategoryRepository")
 */
class SubscribedCategory
{
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    private $categories = [];


    private $matching;


    public function getCategories(): array
    {
        $categories = $this->categories;
        // guarantee every user at least has ROLE_USER
       // $categories[] = 'ROLE_USER';

        return array_unique($categories);
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getMatching(): ?int
    {
        return $this->matching;
    }

    public function setMatching(int $matching): self
    {
        $this->matching = $matching;

        return $this;
    }
}
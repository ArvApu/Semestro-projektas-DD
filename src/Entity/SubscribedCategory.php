<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscribedCategoryRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"user_id", "category_id"})})
 * @UniqueEntity( fields={"user", "category"}, errorPath="category", message="This category is already subscribed.")
 */
class SubscribedCategory
{

     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subscribedCategories")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        //arba be :self ir returna
        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subscribedCategories")
     *
     */
    private $category;

        /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
       public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
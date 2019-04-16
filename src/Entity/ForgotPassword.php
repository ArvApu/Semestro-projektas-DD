<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 2019-04-13
 * Time: 11:37
 */

namespace App\Entity;


class ForgotPassword
{
    private $email;
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
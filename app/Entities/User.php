<?php

namespace App\Entities;

class User
{
    private $id;
    private $name;
    private $email;
    private $image;
    private $helper;

    public function __construct(array $user = [])
    {
        $this->id = isset($user['id']) ? $user['id'] : null;
        $this->name = isset($user['name']) ? $user['name'] : null;
        $this->email = isset($user['email']) ? $user['email'] : null;
        $this->image = isset($user['image']) ? $user['image'] : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageUrl($serverHost)
    {
        if (is_null($this->getImage())) {
            return null;
        }

        return "{$serverHost}/public/assets/images/users/{$this->getImage()}";
    }
}

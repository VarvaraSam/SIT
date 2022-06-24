<?php

namespace App\Entity;

use App\Repository\UserLikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserLikesRepository::class)
 */
class UserLikes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $TypeName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Likes")
     */
    private $UserWhoLikes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->TypeName;
    }

    public function setTypeName(string $TypeName): self
    {
        $this->TypeName = $TypeName;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUserWhoLikes(): ?User
    {
        return $this->UserWhoLikes;
    }

    public function setUserWhoLikes(?User $UserWhoLikes): self
    {
        $this->UserWhoLikes = $UserWhoLikes;

        return $this;
    }
}

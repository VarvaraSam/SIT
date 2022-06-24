<?php

namespace App\Entity;

use App\Repository\UserInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserInfoRepository::class)
 */
class UserInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $registredAt;

    /**
     * @ORM\Column(type="date")
     */
    private $bornAt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Status;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="UserMainInfo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistredAt(): ?\DateTimeImmutable
    {
        return $this->registredAt;
    }

    public function setRegistredAt(\DateTimeImmutable $registredAt): self
    {
        $this->registredAt = $registredAt;

        return $this;
    }

    public function getBornAt(): ?\DateTimeInterface
    {
        return $this->bornAt;
    }

    public function setBornAt(\DateTimeInterface $bornAt): self
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->Owner;
    }

    public function setOwner(User $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    public function __toString() : String
    {
        return $this->bornAt->format('Y-m-d H:i:s') . ' ' . $this->Status;
    }
}

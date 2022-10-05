<?php

namespace App\Entity;

use App\Repository\ApiAccessRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApiAccessRepository::class)]
class ApiAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'apiAccess', cascade: ['persist', 'remove'])]
    private ?User $user_id = null;

    #[ORM\Column]
    private ?int $nb_request_api = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_api_request = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user_id;
    }

    public function setUser(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNbRequestApi(): ?int
    {
        return $this->nb_request_api;
    }

    public function setNbRequestApi(int $nb_request_api): self
    {
        $this->nb_request_api = $nb_request_api;

        return $this;
    }

    public function getLastApiRequest(): ?\DateTimeInterface
    {
        return $this->last_api_request;
    }

    public function setLastApiRequest(\DateTimeInterface $last_api_request): self
    {
        $this->last_api_request = $last_api_request;

        return $this;
    }
}

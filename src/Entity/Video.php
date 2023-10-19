<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ApiResource]
#[ORM\Table(name: "videos")]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    use Timestampable;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez entrer un titre")]
    #[Assert\Length(min: 3, minMessage: "Vous devez avoir un titre de minimum 3 caractères")]
    #[Assert\NotEqualTo(value: "merde", message: "Vous ne pouvez pas introduire le mot grossier (m****)")]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $video_link = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "Veuillez entrer une description")]
    #[Assert\Length(min: 20, minMessage: "Vous devez avoir une description de minimum 20 caractères")]
    #[Assert\NotEqualTo(value: "merde", message: "Vous ne pouvez pas introduire le mot grossier (m****)")]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(string $video_link): static
    {
        $this->video_link = $video_link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

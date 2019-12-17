<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotClesRepository")
 */
class MotCles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mot_cle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Articles", inversedBy="motCles")
     */
    private $articles_id;

    public function __construct()
    {
        $this->articles_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotCle(): ?string
    {
        return $this->mot_cle;
    }

    public function setMotCle(string $mot_cle): self
    {
        $this->mot_cle = $mot_cle;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticlesId(): Collection
    {
        return $this->articles_id;
    }

    public function addArticlesId(Articles $articlesId): self
    {
        if (!$this->articles_id->contains($articlesId)) {
            $this->articles_id[] = $articlesId;
        }

        return $this;
    }

    public function removeArticlesId(Articles $articlesId): self
    {
        if ($this->articles_id->contains($articlesId)) {
            $this->articles_id->removeElement($articlesId);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->mot_cle;
    }
}

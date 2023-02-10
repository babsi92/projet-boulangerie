<?php

namespace App\Entity;

use App\Repository\PaniersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaniersRepository::class)
 */
class Paniers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="paniers")
     */
    private $article;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, mappedBy="panier", cascade={"persist", "remove"})
     */
    private $users;

    public function __construct()
    {
        $this->article = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Produits $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
            $article->setPaniers($this);
        }

        return $this;
    }

    public function removeArticle(Produits $article): self
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getPaniers() === $this) {
                $article->setPaniers(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        // unset the owning side of the relation if necessary
        if ($users === null && $this->users !== null) {
            $this->users->setPanier(null);
        }

        // set the owning side of the relation if necessary
        if ($users !== null && $users->getPanier() !== $this) {
            $users->setPanier($this);
        }

        $this->users = $users;

        return $this;
    }

    
}

<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 * @Vich\Uploadable 
 */
class Produits
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
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;


    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\ManyToOne(targetEntity=Paniers::class, inversedBy="article")
     */
    private $paniers;


    /**
     * @Vich\UploadableField(mapping="produits", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;


    public function getId(): ?int
    {
        return $this->id;
    }
   
    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }


    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getPaniers(): ?Paniers
    {
        return $this->paniers;
    }

    public function setPaniers(?Paniers $paniers): self
    {
        $this->paniers = $paniers;

        return $this;
    }

 public function setImageFile(?File $imageFile = null): void
    {
    $this->imageFile = $imageFile;
}
public function getImageFile(): ?File
    {
    return $this->imageFile;
    }
public function setImageName(?string $imageName): void
    {
    $this->imageName = $imageName;
    }
public function getImageName(): ?string
    {
    return $this->imageName;

    }
}
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
// use Symfony\Component\Validator\Constraints\Length;
// use Symfony\Component\Validator\Constraints\NotBlank;
use symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 32)]
  #[Assert\NotBlank(message: 'Saisir une Marque SVP')]
  #[Assert\Length(
    min: 3,
    minMessage: 'La marque doit contenir au moins {{ limit }} caractères',
    max: 32,
    maxMessage: 'La marque ne doit pas dépasser {{ limit }} caractères'
  )]
  #[Assert\Regex(
    pattern: '/^[a-zA-Z\s-]+$/',
    message: 'La marque ne doit contenir que des lettres, des espaces et des tirets'
  )]

  private ?string $libelle = null;

  #[ORM\OneToMany(mappedBy: 'marque', targetEntity: modele::class)]
  private Collection $modeles;

  public function __construct()
  {
    $this->modeles = new ArrayCollection();
  }

  public function getId(): ?int

  {
    return $this->id;
  }

  public function getLibelle(): ?string
  {
    return $this->libelle;
  }

  public function setLibelle(string $libelle): static
  {
    $this->libelle = $libelle;

    return $this;
  }

  /**
   * @return Collection<int, modele>
   */
  public function getModeles(): Collection
  {
    return $this->modeles;
  }

  public function addModele(modele $modele): static
  {
    if (!$this->modeles->contains($modele)) {
      $this->modeles->add($modele);
      $modele->setMarque($this);
    }

    return $this;
  }

  public function removeModele(modele $modele): static
  {
    if ($this->modeles->removeElement($modele)) {
      // set the owning side to null (unless already changed)
      if ($modele->getMarque() === $this) {
        $modele->setMarque(null);
      }
    }

    return $this;
  }
}

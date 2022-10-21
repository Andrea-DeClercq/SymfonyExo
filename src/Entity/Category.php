<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Contact::class)]
    private Collection $category_title;

    #[ORM\Column(length: 255)]
    private ?string $titre;

    public function __construct()
    {
        $this->title = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getCategoryTitle(): Collection
    {
        return $this->category_title;
    }

    public function addCategoryTitle(Contact $category_title): self
    {
        if (!$this->title->contains($category_title)) {
            $this->title->add($category_title);
            $category_title->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryTitle(Contact $category_title): self
    {
        if ($this->title->removeElement($category_title)) {
            // set the owning side to null (unless already changed)
            if ($category_title->getCategory() === $this) {
                $category_title->setCategory(null);
            }
        }

        return $this;
    }
    
    public function getTitre(){
        return $this->titre;
    }

    public function setTitre(?string $titre){
        $this->titre = $titre;

        return $this;
    }
}

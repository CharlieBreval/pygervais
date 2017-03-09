<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategory
 *
 * @ORM\Table(name="subcategory")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\SubcategoryRepository")
 */
class Subcategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Painting", mappedBy="subcategory")
     */
    private $paintings;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=255, nullable=true)
     */
    private $titleEn;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paintings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getCategory()->getTitle().' - '.$this->getTitle();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Subcategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return Subcategory
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set category
     *
     * @param \AdminBundle\Entity\Category $category
     *
     * @return Subcategory
     */
    public function setCategory(\AdminBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AdminBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add painting
     *
     * @param \AdminBundle\Entity\Painting $painting
     *
     * @return Subcategory
     */
    public function addPainting(\AdminBundle\Entity\Painting $painting)
    {
        $this->paintings[] = $painting;

        return $this;
    }

    /**
     * Remove painting
     *
     * @param \AdminBundle\Entity\Painting $painting
     */
    public function removePainting(\AdminBundle\Entity\Painting $painting)
    {
        $this->paintings->removeElement($painting);
    }

    /**
     * Get paintings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaintings()
    {
        return $this->paintings;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Subcategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}

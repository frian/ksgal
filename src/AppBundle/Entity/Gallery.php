<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Gallery
 *
 * @ORM\Table(name="gallery")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GalleryRepository")
 */
class Gallery
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\OneToMany(targetEntity="GalleryItem", mappedBy="gallery")
     */
    private $galleryItems;
    

    public function __construct()
    {
    	$this->galleryItems = new ArrayCollection();
    }
    
    
    /**
     * stringify
     *
     * @return string
     */
    public function __toString() {
    	return $this->name;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Gallery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Gallery
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add galleryItem
     *
     * @param \AppBundle\Entity\GalleryItem $galleryItem
     *
     * @return Gallery
     */
    public function addGalleryItem(\AppBundle\Entity\GalleryItem $galleryItem)
    {
        $this->galleryItems[] = $galleryItem;

        return $this;
    }

    /**
     * Remove galleryItem
     *
     * @param \AppBundle\Entity\GalleryItem $galleryItem
     */
    public function removeGalleryItem(\AppBundle\Entity\GalleryItem $galleryItem)
    {
        $this->galleryItems->removeElement($galleryItem);
    }

    /**
     * Get galleryItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleryItems()
    {
        return $this->galleryItems;
    }
}

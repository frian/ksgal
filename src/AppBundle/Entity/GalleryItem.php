<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryItem
 *
 * @ORM\Table(name="gallery_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GalleryItemRepository")
 */
class GalleryItem
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensions", type="string", length=255, nullable=true)
     */
    private $dimensions;

    /**
     * @var string
     *
     * @ORM\Column(name="techniques", type="string", length=255, nullable=true)
     */
    private $techniques;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="bgimage", type="string", length=255)
     */
    private $bgimage;


    /**
     * Gallery containing the item
     *
     * @var TimeTM\CoreBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gallery", inversedBy="galleryItems", cascade={"persist"})
     */
    private $gallery;


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
     * @return GalleryItem
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
     * Set dimensions
     *
     * @param string $dimensions
     *
     * @return GalleryItem
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set techniques
     *
     * @param string $techniques
     *
     * @return GalleryItem
     */
    public function setTechniques($techniques)
    {
        $this->techniques = $techniques;

        return $this;
    }

    /**
     * Get techniques
     *
     * @return string
     */
    public function getTechniques()
    {
        return $this->techniques;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return GalleryItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set bgimage
     *
     * @param string $bgimage
     *
     * @return GalleryItem
     */
    public function setBgimage($bgimage)
    {
        $this->bgimage = $bgimage;

        return $this;
    }

    /**
     * Get bgimage
     *
     * @return string
     */
    public function getBgimage()
    {
        return $this->bgimage;
    }


    /**
     * Set gallery
     *
     * @param integer $user
     * @return gallery
     */
    public function setGallery($gallery)
    {
    	$this->gallery = $gallery;
    
    	return $this;
    }
    
    /**
     * Get userId
     *
     * @return integer
     */
    public function getGallery()
    {
    	return $this->gallery;
    }
    
}


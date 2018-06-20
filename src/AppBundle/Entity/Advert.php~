<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 */
class Advert
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


    // Relation one to many entre app et advert.

    /**
    * @ORM\OneToMany(targetEntity="Application", mappedBy="application_advert", cascade={"remove"})
    */
    private $advert_application;

    //Relation entre advert et user

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="user_advert")
    * @ORM\JoinColumn(name="advert_user", referencedColumnName="id")
    */
    private $advert_user;


    //Many to many adv/categorys
    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="adverts")
     * @ORM\JoinTable(name="adverts_categories")
     */
    private $adverts_categories;



    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
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
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add advertApplication
     *
     * @param \AppBundle\Entity\Application $advertApplication
     *
     * @return Advert
     */
    public function addAdvertApplication(\AppBundle\Entity\Application $advertApplication)
    {
        $this->advert_application[] = $advertApplication;

        return $this;
    }

    /**
     * Remove advertApplication
     *
     * @param \AppBundle\Entity\Application $advertApplication
     */
    public function removeAdvertApplication(\AppBundle\Entity\Application $advertApplication)
    {
        $this->advert_application->removeElement($advertApplication);
    }

    /**
     * Get advertApplication
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertApplication()
    {
        return $this->advert_application;
    }

    /**
     * Set advertUser
     *
     * @param \AppBundle\Entity\User $advertUser
     *
     * @return Advert
     */
    public function setAdvertUser(\AppBundle\Entity\User $advertUser = null)
    {
        $this->advert_user = $advertUser;

        return $this;
    }

    /**
     * Get advertUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getAdvertUser()
    {
        return $this->advert_user;
    }



    /**
     * Add advertsCategory
     *
     * @param \AppBundle\Entity\Category $advertsCategory
     *
     * @return Advert
     */
    public function addAdvertsCategory(\AppBundle\Entity\Category $advertsCategory)
    {
        $this->adverts_categories[] = $advertsCategory;

        return $this;
    }

    /**
     * Remove advertsCategory
     *
     * @param \AppBundle\Entity\Category $advertsCategory
     */
    public function removeAdvertsCategory(\AppBundle\Entity\Category $advertsCategory)
    {
        $this->adverts_categories->removeElement($advertsCategory);
    }

    /**
     * Get advertsCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertsCategories()
    {
        return $this->adverts_categories;
    }
}

<?php

namespace ProjetInvest\ProjetPresentationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProjetInvest\InvestorBundle\Entity\Investor;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ProjetInvest\ProjetPresentationBundle\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
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
     * @ORM\Column(name="titre", type="string", length=255, unique=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="ProjetInvest\ProjetPresentationBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @ORM\Column(name="budget_target", type="integer")
     */
    private $budgettarget;

    /**
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\ManyToMany(targetEntity="ProjetInvest\InvestorBundle\Entity\Investor", cascade={"persist"})
     */
    private $investors;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    public function __construct()
    {
        // Par défaut, la date de création du projet est la date d'aujourd'hui
        $this->dateCreation = new \DateTime('now');
        $this->investors = new ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Project
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
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
     * Set image
     *
     * @param string $image
     *
     * @return Project
     */
    public function setImage(Image $image = null)
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Project
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Project
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Project
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Project
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Add investor
     *
     * @param \ProjetInvest\InvestorBundle\Entity\Investor $investor
     *
     * @return Project
     */
    public function addInvestor(\ProjetInvest\InvestorBundle\Entity\Investor $investor)
    {
        $this->investors[] = $investor;

        return $this;
    }

    /**
     * Remove investor
     *
     * @param \ProjetInvest\InvestorBundle\Entity\Investor $investor
     */
    public function removeInvestor(\ProjetInvest\InvestorBundle\Entity\Investor $investor)
    {
        $this->investors->removeElement($investor);
    }

    /**
     * Get investor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvestors()
    {
        return $this->investors;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Project
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updatedDate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Set budgetTarget
     *
     * @param integer $budgetTarget
     *
     * @return Project
     */
    public function setBudgetTarget($budgetTarget)
    {
        $this->budgettarget = $budgetTarget;

        return $this;
    }

    /**
     * Get budgetTarget
     *
     * @return integer
     */
    public function getBudgetTarget()
    {
        return $this->budgettarget;
    }

    /**
     * Set donation
     *
     * @param integer $donation
     *
     * @return Project
     */
    public function setDonation($donation)
    {
        $this->donation = $this->donation + $donation;

        return $this;
    }

    /**
     * Get donation
     *
     * @return integer
     */
    public function getDonation()
    {
        return $this->donation;
    }
}
